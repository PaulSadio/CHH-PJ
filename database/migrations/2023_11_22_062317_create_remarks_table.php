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
        // Schema::create('remarks', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        //     $table->string('memberremark');
            
        // });
        if (!Schema::hasTable('remarks')) {
            Schema::create('remarks', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('member_id');
                $table->text('memberremark');
                $table->timestamps();
        
                $table->foreign('member_id')->references('id')->on('memberss')->onDelete('cascade');
            });
        }
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarks');
    }
};
