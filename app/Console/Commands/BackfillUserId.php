<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackfillUserId extends Command
{
    protected $signature = 'users:backfill-userid';

    protected $description = 'Set userID = 3 on creatable tables where userID is currently null';

    private array $tables = [
        'News',
        'Event',
        'Document',
        'Gallery',
        'Partner',
        'Committe',
        'Season',
        'Day',
        'TeamCategory',
        'Team',
        'Game',
        'TopScore',
        'PlayerSuspended',
        'TeamStatistic',
    ];

    public function handle()
    {
        $userId = 3;

        if (!User::where('id', $userId)->exists()) {
            $this->error("User with id {$userId} was not found. Create that user before backfilling.");
            return 1;
        }

        $totalUpdated = 0;

        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'userID')) {
                $this->warn("Skipped {$table} (table or userID column missing)");
                continue;
            }

            $updated = DB::table($table)
                ->whereNull('userID')
                ->update(['userID' => $userId]);

            $totalUpdated += $updated;
            $this->info("{$table}: {$updated} row(s) updated");
        }

        $this->info("Done. Total rows updated: {$totalUpdated}");

        return 0;
    }
}
