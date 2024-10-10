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
        Schema::table('Team', function (Blueprint $table) {
            $table->unsignedBigInteger('divisionID')->nullable();

            $table->foreign('divisionID')->references('id')->on('Division')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Team', function (Blueprint $table) {
            $table->dropColumn('divisionID');
        });
    }
};
