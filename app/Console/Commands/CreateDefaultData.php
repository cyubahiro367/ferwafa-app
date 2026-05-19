<?php

namespace App\Console\Commands;

use App\Models\CommitteeCategory;
use App\Models\Division;
use App\Models\DocumentType;
use App\Models\Group;
use App\Models\Key;
use App\Models\NewsType;
use App\Models\Permission;
use App\Models\Season;
use App\Models\Status;
use App\Models\TeamCategory;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateDefaultData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:default-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $documentTypes = [
            "report",
            "document",
            "game-rules",
            "additional-rules",
            "circular"
        ];

        $status = [
            "published",
            "draft",
            "unpublished"
        ];

        $permissions = [
            'admin',
            'dcm',
            'competition-manager'
        ];

        $newsTypes = [
            'National-team-men-senior',
            'National-team-men-U-23-Olympic',
            'National-team-men-U-17',
            'National-team-men-other',
            'National-team-women-senior',
            'National-team-women-U-20',
            'National-team-women-other',
            'Grassroots-football',
            'Football-for-schools',
            'Youth-Development',
            'other'
        ];

        $divisions = [
            "First Division",
            "Second Division"
        ];

        $groups = [
            "Group A",
            "Group B"
        ];

        $teamCategory = [
            "Men",
            "Women"
        ];

        $committeeCategory = [
            "Conflicts resolution committee",
            "Player Status Committee",
            "Ethic Committee",
            "Disciplinary committee",
            "Appeal Committee",
            "Audit committee",
            "Electoral Committee",
            "Appeal Electoral Committee",
            "Club licensing|FBI",
            "Club licensing|SIB",
            "Executive Committee"
        ];

        try {
            DB::transaction(function () use ($documentTypes, $status, $permissions, $newsTypes, $divisions, $groups, $teamCategory, $committeeCategory) {

                foreach ($documentTypes as $documentType) {
                    DocumentType::firstOrCreate([
                        "name" => $documentType
                    ]);
                }

                foreach ($status as $value) {
                    Status::firstOrCreate([
                        "name" => $value
                    ]);
                }

                foreach ($permissions as $value) {
                    Permission::firstOrCreate([
                        "name" => $value
                    ]);
                }

                foreach ($newsTypes as $value) {
                    NewsType::firstOrCreate([
                        'name' => $value
                    ]);
                }

                foreach ($divisions as $value) {
                    Division::firstOrCreate([
                        'name' => $value
                    ]);
                }

                foreach ($groups as $value) {
                    Group::firstOrCreate([
                        'name' => $value
                    ]);
                }

                foreach ($teamCategory as $value) {
                    TeamCategory::firstOrCreate([
                        'name' => $value
                    ]);
                }

                foreach ($committeeCategory as $value) {
                    CommitteeCategory::firstOrCreate([
                        'name' => $value
                    ]);
                }

                $year = now()->year;
                Season::firstOrCreate([
                    "from" => strtotime("$year-08-01"),
                    "to" => strtotime("$year-05-31")
                ]);

                $permission = Permission::firstOrCreate([
                    "name" => "admin",
                ]);

                $payload =  [
                    "permissionID" => $permission->id,
                    "timestamp" => time(),
                ];

                $jwt = JWT::encode($payload, 'admin', 'HS256');

                $key = Key::firstOrCreate([
                    "value" => $jwt,
                    "permissionID" => $permission->id,
                ]);

                User::firstOrCreate([
                    'name' => "Cyubahiro Theotime",
                    'email' => "theotimecyubahiro@gmail.com",
                    'password' => Hash::make("password"),
                    'keyID' => $key->id
                ]);
            });
            $this->info('Default Data Inserted successfully');
        } catch (\Throwable $th) {
            $this->error("Contact Support");
        }
    }
}
