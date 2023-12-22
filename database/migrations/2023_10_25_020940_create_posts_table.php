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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title', 100)->index();
            // $table->foreignId('category_id')->constrained()->index();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('image', 255);
            $table->string('slag', 100)->index();
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
