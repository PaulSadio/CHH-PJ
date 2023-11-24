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
       if(!Schema::hasTable('memberss')){
        Schema::create('memberss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('membername');
            $table->string('memberaddress');
            $table->string('memberemail');
            $table->integer('contactnumber');
            $table->integer('memberage');
            $table->string('membersex');
            $table->date('birthday');
            $table->string('profilepic', 300)->nullable();
            $table->timestamps();
            // $table->integer('remarkid')->unsigned();
            // $table->foreign('remarkid')->references('id')->on('remarks');
        });
       }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberss');
    }
};
