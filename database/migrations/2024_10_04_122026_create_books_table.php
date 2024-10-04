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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedInteger('year')->nullable();
            $table->timestamps();

            $table->foreign("category_id", 'books__category_id__to__categories__id')
                ->references("id")
                ->on('categories')
                ->cascadeOnDelete();

            $table->foreign("author_id", 'books__author_id__to__authors__id')
                ->references("id")
                ->on('authors')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
