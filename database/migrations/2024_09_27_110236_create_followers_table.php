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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id');
            $table->unsignedBigInteger('leader_id');
            $table->timestamps();

            $table->foreign('follower_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('leader_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropForeign(['follower_id', "leader_id"]);
        Schema::dropIfExists('followers');
    }
};
