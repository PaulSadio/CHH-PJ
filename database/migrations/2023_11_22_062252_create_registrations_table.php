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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('event_id')->nullable();
            $table->string('participantname');
            $table->integer('participantid')->nullable();
            $table->string('participantemail');
            $table->integer('participant_status')->default(0);
            $table->foreign('event_id')->references('id')->on('proposals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
