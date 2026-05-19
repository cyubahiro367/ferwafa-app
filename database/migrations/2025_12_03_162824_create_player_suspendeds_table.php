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
        Schema::create('PlayerSuspended', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('seasonID');
            $table->unsignedBigInteger('dayID');
            $table->unsignedBigInteger('teamID');

            $table->string('name');
            $table->string('reason', 30);

            $table->timestamps();

            // Foreign keys
            $table->foreign('seasonID')->references('id')->on('Season')->onDelete('cascade');
            $table->foreign('dayID')->references('id')->on('Day')->onDelete('cascade');
            $table->foreign('teamID')->references('id')->on('Team')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PlayerSuspended');
    }
};
