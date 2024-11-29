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
        Schema::create('working_programs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('core_team_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreign('core_team_id')->references('id')->on('core_teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_programs');
    }
};
