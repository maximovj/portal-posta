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
        Schema::create('rating_articles', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('moonshine_user_id')
            ->nullable()
            ->constrained('moonshine_users', 'id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('article_id')
            ->nullable()
            ->constrained('articles', 'id')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->tinyInteger('rating')->unsigned();
            $table->boolean('is_active')->nullable()->default(false);

            $table->unique(['moonshine_user_id', 'article_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_articles');
    }
};
