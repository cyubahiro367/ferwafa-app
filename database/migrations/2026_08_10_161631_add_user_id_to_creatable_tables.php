<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'userID')) {
                    $table->unsignedBigInteger('userID')->nullable()->after('id');
                    $table->foreign('userID')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (!Schema::hasTable($tableName) || !Schema::hasColumn($tableName, 'userID')) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['userID']);
                $table->dropColumn('userID');
            });
        }
    }
};
