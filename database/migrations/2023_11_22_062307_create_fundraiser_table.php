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
        Schema::create('fundraiser', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fundraiser_title');
            $table->integer('fundraiser_amount');
            $table->date('fundraiser_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundraiser');
    }
};
