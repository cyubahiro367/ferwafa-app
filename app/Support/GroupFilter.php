<?php

namespace App\Support;

use App\Models\Group;
use App\Models\Season;
use Illuminate\Http\Request;

class GroupFilter
{
    public static function applies(int $divisionID, Season $season): bool
    {
        return $divisionID === 2 && ($season->playsInGroups ?? true);
    }

    public static function defaultGroupId(): ?int
    {
        $defaultGroup = Group::orderBy('name')->get()->first(function ($group) {
            $name = strtolower(trim((string) $group->name));

            return $name === 'group a' || $name === 'a';
        });

        return $defaultGroup?->id ?? Group::orderBy('name')->value('id');
    }

    public static function resolveGroupId(
        Request $request,
        ?int $routeGroupId,
        Season $season,
        int $divisionID
    ): ?int {
        if (! self::applies($divisionID, $season)) {
            return null;
        }

        $groupId = $request->filled('groupID')
            ? ($request->integer('groupID') ?: null)
            : $routeGroupId;

        return $groupId ?: self::defaultGroupId();
    }
}
