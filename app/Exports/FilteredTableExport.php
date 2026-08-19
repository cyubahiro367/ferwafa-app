<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithFreezePane;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredTableExport implements FromArray, WithColumnWidths, WithEvents, WithFreezePane, WithTitle
{
    private const NAVY = '0E1B3A';

    private const GOLD = 'F0A83C';

    private const HEADER = '16264D';

    private const ALT = 'F5F6FA';

    private const PUBLISHED_BG = 'E7F5EC';

    private const PUBLISHED_FG = '125C36';

    private const OTHER_BG = 'FCEBEA';

    private const OTHER_FG = '9A2A22';

    /** @var array<int, array<int, mixed>> */
    private array $sheetRows;

    private int $columnCount;

    private int $headerRow;

    private int $firstDataRow;

    private int $lastDataRow;

    private int $footerRow;

    /** @var array<string, float|int> */
    private array $columnWidths;

    /** @var array<int, string> */
    private array $wrapColumns;

    private ?int $statusIndex;

    private string $title;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function __construct(array $payload)
    {
        $this->title = (string) $payload['title'];
        $this->columnWidths = $payload['columnWidths'] ?? [];
        $this->wrapColumns = $payload['wrapColumns'] ?? [];
        $this->statusIndex = $payload['statusIndex'] ?? null;

        $headings = array_values($payload['headings']);
        $rows = $payload['rows'];
        $filters = $payload['filters'];

        $this->columnCount = max(count($headings), 2);

        $sheetRows = [];
        $sheetRows[] = [$payload['brand']];
        $sheetRows[] = [$this->title];
        $sheetRows[] = array_fill(0, $this->columnCount, '');

        foreach ($filters as $filter) {
            $sheetRows[] = [$filter['label'], $filter['value']];
        }

        $sheetRows[] = array_fill(0, $this->columnCount, '');
        $this->headerRow = count($sheetRows) + 1;
        $sheetRows[] = $headings;
        $this->firstDataRow = $this->headerRow + 1;

        if ($rows === []) {
            $sheetRows[] = ['No records in this range.'];
        } else {
            foreach ($rows as $row) {
                $sheetRows[] = array_values($row);
            }
        }

        $this->lastDataRow = count($sheetRows);
        $sheetRows[] = array_fill(0, $this->columnCount, '');
        $this->footerRow = count($sheetRows) + 1;
        $sheetRows[] = [$payload['footer'] . '  ' . $payload['generatedAt']];

        $this->sheetRows = $sheetRows;
    }

    public function array(): array
    {
        return $this->sheetRows;
    }

    public function title(): string
    {
        return mb_substr($this->title, 0, 31);
    }

    public function columnWidths(): array
    {
        if ($this->columnWidths !== []) {
            return $this->columnWidths;
        }

        $widths = [];
        for ($i = 1; $i <= $this->columnCount; $i++) {
            $letter = Coordinate::stringFromColumnIndex($i);
            $widths[$letter] = 22;
        }

        return $widths;
    }

    public function freezePane(): string
    {
        return 'A' . $this->firstDataRow;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->styleSheet($event->sheet->getDelegate());
            },
        ];
    }

    private function styleSheet(Worksheet $sheet): void
    {
        $lastCol = Coordinate::stringFromColumnIndex($this->columnCount);

        $sheet->getParent()?->getDefaultStyle()->getFont()->setName('Calibri')->setSize(11);
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd($this->headerRow, $this->headerRow);
        $sheet->getPageMargins()->setTop(0.4)->setBottom(0.4)->setLeft(0.35)->setRight(0.35);

        $sheet->mergeCells("A1:{$lastCol}1");
        $sheet->mergeCells("A2:{$lastCol}2");
        $sheet->mergeCells("A3:{$lastCol}3");
        $sheet->mergeCells("A{$this->footerRow}:{$lastCol}{$this->footerRow}");

        $sheet->getRowDimension(1)->setRowHeight(22);
        $sheet->getRowDimension(2)->setRowHeight(28);
        $sheet->getRowDimension(3)->setRowHeight(8);
        $sheet->getRowDimension($this->headerRow)->setRowHeight(22);
        $sheet->getRowDimension($this->footerRow)->setRowHeight(22);

        $this->fill($sheet, "A1:{$lastCol}2", self::NAVY);
        $this->fill($sheet, "A3:{$lastCol}3", self::GOLD);

        $sheet->getStyle('A1')->getFont()->setName('Calibri')->setBold(true)->setSize(12)->getColor()->setRGB(self::GOLD);
        $sheet->getStyle('A2')->getFont()->setName('Calibri')->setBold(true)->setSize(16)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle("A1:{$lastCol}2")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $filterStart = 4;
        $filterEnd = $this->headerRow - 2;
        for ($row = $filterStart; $row <= $filterEnd; $row++) {
            $sheet->mergeCells("B{$row}:{$lastCol}{$row}");
            $sheet->getRowDimension($row)->setRowHeight(18);
            $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setName('Calibri')->setSize(10)->getColor()->setRGB(self::NAVY);
            $sheet->getStyle("B{$row}")->getFont()->setName('Calibri')->setSize(10)->getColor()->setRGB('1F2937');
            $sheet->getStyle("A{$row}:{$lastCol}{$row}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }

        $this->fill($sheet, "A{$this->headerRow}:{$lastCol}{$this->headerRow}", self::HEADER);
        $sheet->getStyle("A{$this->headerRow}:{$lastCol}{$this->headerRow}")->getFont()
            ->setName('Calibri')->setBold(true)->setSize(11)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle("A{$this->headerRow}:{$lastCol}{$this->headerRow}")->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_LEFT);

        for ($row = $this->firstDataRow; $row <= $this->lastDataRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(18);
            $alt = (($row - $this->firstDataRow) % 2) === 1;
            $this->fill($sheet, "A{$row}:{$lastCol}{$row}", $alt ? self::ALT : 'FFFFFF');
            $sheet->getStyle("A{$row}:{$lastCol}{$row}")->getFont()->setName('Calibri')->setSize(10);
            $sheet->getStyle("A{$row}:{$lastCol}{$row}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }

        $sheet->getStyle("A{$this->headerRow}:{$lastCol}{$this->lastDataRow}")->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->getColor()->setRGB('D5D8E0');

        foreach ($this->wrapColumns as $column) {
            $sheet->getStyle("{$column}{$this->firstDataRow}:{$column}{$this->lastDataRow}")
                ->getAlignment()
                ->setWrapText(true)
                ->setVertical(Alignment::VERTICAL_CENTER);
        }

        if ($this->statusIndex !== null) {
            $statusCol = Coordinate::stringFromColumnIndex($this->statusIndex + 1);
            for ($row = $this->firstDataRow; $row <= $this->lastDataRow; $row++) {
                $value = strtolower(trim((string) $sheet->getCell($statusCol . $row)->getValue()));
                if ($value === '' || $value === 'no records in this range.') {
                    continue;
                }

                $published = $value === 'published';
                $this->fill($sheet, $statusCol . $row, $published ? self::PUBLISHED_BG : self::OTHER_BG);
                $sheet->getStyle($statusCol . $row)->getFont()
                    ->setBold(true)
                    ->getColor()
                    ->setRGB($published ? self::PUBLISHED_FG : self::OTHER_FG);
                $sheet->getStyle($statusCol . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        }

        $sheet->getStyle("A{$this->footerRow}")->getFont()->setName('Calibri')->setItalic(true)->setSize(9)->getColor()->setRGB('6B7280');
        $sheet->getStyle("A{$this->footerRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }

    private function fill(Worksheet $sheet, string $range, string $rgb): void
    {
        $sheet->getStyle($range)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($rgb);
    }
}
