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
        Schema::create('digests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->string('meta_description')->default('');
            $table->boolean('is_published_to_facebook')->default(false);
            $table->boolean('is_published_to_twitter')->default(false);
            $table->boolean('is_published')->default(false);
            $table->integer('views')->default(0);
            $table->string('keywords', 255)->default('');
            $table->json('likes')->default('[]');
            $table->json('dislikes')->default('[]');
            $table->string('image')->default('');
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digests');
    }
};
