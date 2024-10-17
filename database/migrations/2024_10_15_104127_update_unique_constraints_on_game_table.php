<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('Game', function (Blueprint $table) {
            $table->dropForeign(['homeTeamID']);
            $table->dropUnique('hometeamperday'); // Drops unique for ['homeTeamID', 'dayID']

            $table->dropForeign(['awayTeamID']);
            $table->dropUnique('awayteamperday');

            $table->foreign('homeTeamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('awayTeamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unique(['homeTeamID', 'dayID', 'seasonID'], 'hometeamperday');
            $table->unique(['awayTeamID', 'dayID', 'seasonID'], 'awayteamperday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Game', function (Blueprint $table) {
            $table->dropUnique('hometeamperday'); // Drops unique for ['homeTeamID', 'dayID', 'seasonID']
            $table->dropUnique('awayteamperday'); // Drops unique for ['awayTeamID', 'dayID', 'seasonID']
            
            // Add the old unique constraints back
            $table->unique(['homeTeamID', 'dayID'], 'hometeamperday');
            $table->unique(['awayTeamID', 'dayID'], 'awayteamperday');

            $table->foreign('homeTeamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('awayTeamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
};
