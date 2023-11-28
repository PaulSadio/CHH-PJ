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
        Schema::create('annualfee', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('annualfee_id');
            $table->integer('annualfee_status')->default(0); //0:pending, 1:paid
            $table->integer('annualfee_amount')->default(50);
            $table->timestamps();
            $table->foreign('annualfee_id')->references('id')->on('memberss');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annualfee');
    }
};
