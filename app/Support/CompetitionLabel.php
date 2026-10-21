<?php

namespace App\Support;

use App\Models\Division;
use App\Models\TeamCategory;

class CompetitionLabel
{
    public static function for(?int $divisionID, ?int $categoryID): ?string
    {
        if (!$divisionID || !$categoryID) {
            return null;
        }

        $category = TeamCategory::find($categoryID);
        $division = Division::find($divisionID);

        if (!$category || !$division) {
            return null;
        }

        return $category->name.' · '.$division->name;
    }
}
