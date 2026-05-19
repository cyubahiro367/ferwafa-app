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
        Schema::table('TopScore', function (Blueprint $table) {
            $table->unsignedBigInteger("seasonID")->default(1);

            $table->foreign('seasonID')->references('id')->on('Season')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('TopScore', function (Blueprint $table) {
            $table->dropForeign(["seasonID"]);
            $table->dropColumn("seasonID");
        });
    }
};
