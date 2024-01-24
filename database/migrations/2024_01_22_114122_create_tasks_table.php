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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->text('description');
            $table->unsignedBigInteger('author_user_id');
            $table->unsignedBigInteger('assigned_user_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('author_user_id')->references('id')->on('users');
            $table->foreign('assigned_user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('parent_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
