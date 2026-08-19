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
     * @return array{from: string, to: string, userId: int|null, fromStart: Carbon, toEnd: Carbon}
     */
    public static function fromRequest(Request $request): array
    {
        $from = self::parseDate($request->input('from')) ?? now()->subMonth();
        $to = self::parseDate($request->input('to')) ?? now();

        if ($from->gt($to)) {
            [$from, $to] = [$to->copy(), $from->copy()];
        }

        $from = $from->copy()->startOfDay();
        $to = $to->copy()->endOfDay();

        $userId = $request->integer('userID') ?: null;

        return [
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
            'userId' => $userId,
            'fromStart' => $from,
            'toEnd' => $to,
        ];
    }

    /**
     * @param  EloquentBuilder|QueryBuilder  $query
     * @param  array{fromStart: Carbon, toEnd: Carbon, userId: int|null}  $filters
     * @return EloquentBuilder|QueryBuilder
     */
    public static function apply($query, array $filters, string $userColumn = 'userID', string $dateColumn = 'created_at')
    {
        $query->whereBetween($dateColumn, [$filters['fromStart'], $filters['toEnd']]);

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
    public static function viewData(Request $request): array
    {
        $filters = self::fromRequest($request);

        return [
            'users' => self::users(),
            'from' => $filters['from'],
            'to' => $filters['to'],
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
