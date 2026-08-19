<?php

namespace App\Support;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;

class ListFilters
{
    /**
     * @return array{from: string|null, to: string|null, userId: int|null, fromStart: Carbon|null, toEnd: Carbon|null}
     */
    public static function fromRequest(Request $request, bool $defaultDates = false): array
    {
        $from = self::parseDate($request->input('from'));
        $to = self::parseDate($request->input('to'));

        if ($defaultDates) {
            $from ??= now()->subMonth();
            $to ??= now();
        }

        if ($from && $to && $from->gt($to)) {
            [$from, $to] = [$to->copy(), $from->copy()];
        }

        $from = $from?->copy()->startOfDay();
        $to = $to?->copy()->endOfDay();

        $userId = $request->integer('userID') ?: null;

        return [
            'from' => $from?->toDateString(),
            'to' => $to?->toDateString(),
            'userId' => $userId,
            'fromStart' => $from,
            'toEnd' => $to,
        ];
    }

    /**
     * @param  EloquentBuilder|QueryBuilder  $query
     * @param  array{fromStart: Carbon|null, toEnd: Carbon|null, userId: int|null}  $filters
     * @return EloquentBuilder|QueryBuilder
     */
    public static function apply($query, array $filters, string $userColumn = 'userID', string $dateColumn = 'created_at')
    {
        $fromStart = $filters['fromStart'] ?? null;
        $toEnd = $filters['toEnd'] ?? null;

        if ($fromStart && $toEnd) {
            $query->whereBetween($dateColumn, [$fromStart, $toEnd]);
        } elseif ($fromStart) {
            $query->where($dateColumn, '>=', $fromStart);
        } elseif ($toEnd) {
            $query->where($dateColumn, '<=', $toEnd);
        }

        if (! empty($filters['userId'])) {
            $query->where($userColumn, $filters['userId']);
        }

        return $query;
    }

    public static function users(): Collection
    {
        return User::orderBy('name')->get(['id', 'name', 'email']);
    }

    /**
     * @return array{users: Collection, from: string, to: string, userId: int|null}
     */
    public static function viewData(Request $request, bool $defaultDates = false): array
    {
        $filters = self::fromRequest($request, $defaultDates);

        return [
            'users' => self::users(),
            'from' => $filters['from'] ?? '',
            'to' => $filters['to'] ?? '',
            'userId' => $filters['userId'],
        ];
    }

    private static function parseDate(mixed $value): ?Carbon
    {
        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (Throwable) {
            return null;
        }
    }
}
