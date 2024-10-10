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
        Schema::table('Committe', function (Blueprint $table) {

            $table->unsignedBigInteger("committeeCategoryID")->default(11);

            $table->foreign('committeeCategoryID')->references('id')->on('CommitteeCategory')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Committe', function (Blueprint $table) {
            $table->dropForeign(["committeeCategoryID"]);
            $table->dropColumn("committeeCategoryID");
        });
    }
};
