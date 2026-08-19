<?php

namespace App\Support;

use App\Exports\FilteredTableExport;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class FilteredExport
{
    public static function requested(Request $request): bool
    {
        return in_array($request->input('format'), ['xlsx', 'pdf'], true);
    }

    /**
     * @param  array{from: string, to: string, userId: int|null}  $filters
     * @param  array<int, string>  $headings
     * @param  array<int, array<int, mixed>>  $rows
     * @param  array{
     *     extraFilters?: array<string, string>,
     *     columnWidths?: array<string, float|int>,
     *     wrapColumns?: array<int, string>
     * }  $options
     */
    public static function download(
        string $title,
        array $filters,
        array $headings,
        array $rows,
        string $format,
        array $options = [],
    ): BinaryFileResponse|Response {
        $payload = self::payload($title, $filters, $headings, $rows, $options);
        $filename = Str::slug($title) . '-' . $filters['from'] . '-to-' . $filters['to'];

        if ($format === 'xlsx') {
            return Excel::download(new FilteredTableExport($payload), $filename . '.xlsx');
        }

        return self::snappyPdf($payload)->inline($filename . '.pdf');
    }

    /**
     * @param  array{from: string, to: string, userId: int|null}  $filters
     * @param  array<int, string>  $headings
     * @param  array<int, array<int, mixed>>  $rows
     * @param  array{
     *     extraFilters?: array<string, string>,
     *     columnWidths?: array<string, float|int>,
     *     wrapColumns?: array<int, string>
     * }  $options
     */
    public static function store(
        string $relativePathWithoutExtension,
        string $title,
        array $filters,
        array $headings,
        array $rows,
        array $options = [],
    ): void {
        $payload = self::payload($title, $filters, $headings, $rows, $options);
        $directory = dirname(storage_path('app/' . $relativePathWithoutExtension));

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $xlsxPath = storage_path('app/' . $relativePathWithoutExtension . '.xlsx');
        file_put_contents($xlsxPath, Excel::raw(new FilteredTableExport($payload), \Maatwebsite\Excel\Excel::XLSX));
        self::snappyPdf($payload)->save(storage_path('app/' . $relativePathWithoutExtension . '.pdf'), true);
    }

    /**
     * @param  array{from: string, to: string, userId: int|null}  $filters
     * @param  array<int, string>  $headings
     * @param  array<int, array<int, mixed>>  $rows
     * @param  array{
     *     extraFilters?: array<string, string>,
     *     columnWidths?: array<string, float|int>,
     *     wrapColumns?: array<int, string>
     * }  $options
     * @return array<string, mixed>
     */
    public static function payload(
        string $title,
        array $filters,
        array $headings,
        array $rows,
        array $options = [],
    ): array {
        $generatedAt = now()->format('j M Y, H:i');
        $filterSummary = self::filterSummary($filters, count($rows), $options['extraFilters'] ?? []);
        $statusIndex = self::headingIndex($headings, 'Status');

        return [
            'brand' => 'FERWAFA · Rwanda Football Federation',
            'title' => self::reportTitle($title),
            'generatedAt' => $generatedAt,
            'footer' => 'Generated automatically by the FERWAFA admin panel — Reports module.',
            'filters' => $filterSummary,
            'headings' => $headings,
            'rows' => $rows,
            'columnWidths' => $options['columnWidths'] ?? [],
            'wrapColumns' => $options['wrapColumns'] ?? [],
            'statusIndex' => $statusIndex,
        ];
    }

    /**
     * @param  array{from: string, to: string, userId: int|null}  $filters
     */
    public static function subtitle(array $filters): string
    {
        $range = Carbon::parse($filters['from'])->format('j M Y')
            . ' – '
            . Carbon::parse($filters['to'])->format('j M Y');

        if (! empty($filters['userId'])) {
            $user = User::find($filters['userId']);
            if ($user) {
                return $user->name . ' · ' . $range;
            }
        }

        return 'All users · ' . $range;
    }

    /**
     * @param  array{from: string, to: string, userId: int|null}  $filters
     * @param  array<string, string>  $extraFilters
     * @return array<int, array{label: string, value: string}>
     */
    private static function filterSummary(array $filters, int $total, array $extraFilters): array
    {
        $range = Carbon::parse($filters['from'])->format('j M Y')
            . ' – '
            . Carbon::parse($filters['to'])->format('j M Y');

        $createdBy = 'All users';
        if (! empty($filters['userId'])) {
            $user = User::find($filters['userId']);
            if ($user) {
                $createdBy = $user->name;
            }
        }

        $summary = [
            ['label' => 'Date range', 'value' => $range],
            ['label' => 'Created by', 'value' => $createdBy],
        ];

        foreach ($extraFilters as $label => $value) {
            $summary[] = ['label' => $label, 'value' => $value];
        }

        $summary[] = ['label' => 'Total', 'value' => (string) $total];

        return $summary;
    }

    private static function reportTitle(string $title): string
    {
        $title = Str::upper(trim($title));

        return str_ends_with($title, ' REPORT') ? $title : $title . ' REPORT';
    }

    /**
     * @param  array<int, string>  $headings
     */
    private static function headingIndex(array $headings, string $name): ?int
    {
        foreach ($headings as $index => $heading) {
            if (strcasecmp((string) $heading, $name) === 0) {
                return (int) $index;
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private static function snappyPdf(array $payload)
    {
        $headerPath = self::writeTempHtml('header', view('admin.exports.pdf-header', $payload)->render());
        $footerPath = self::writeTempHtml('footer', view('admin.exports.pdf-footer', $payload)->render());

        return SnappyPdf::loadView('admin.exports.table', $payload)
            ->setOrientation('landscape')
            ->setOption('encoding', 'UTF-8')
            ->setOption('margin-top', '22mm')
            ->setOption('margin-bottom', '16mm')
            ->setOption('margin-left', '10mm')
            ->setOption('margin-right', '10mm')
            ->setOption('header-html', $headerPath)
            ->setOption('footer-html', $footerPath)
            ->setOption('header-spacing', 3)
            ->setOption('footer-spacing', 2);
    }

    private static function writeTempHtml(string $prefix, string $html): string
    {
        $path = sys_get_temp_dir() . '/ferwafa-export-' . $prefix . '-' . uniqid('', true) . '.html';
        file_put_contents($path, $html);

        return 'file://' . $path;
    }
}
