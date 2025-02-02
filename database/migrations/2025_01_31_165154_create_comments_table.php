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
        Schema::create('comments', function (Blueprint $table) {
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

            $table->foreignId('parent_id')
            ->nullable()
            ->constrained('comments')
            ->onDelete('cascade')
            ->onUpdate('cascade'); // Para respuestas

            $table->string('title')->nullable()->default('na');
            $table->string('tags')->nullable()->default('nuevo');
            $table->text('content')->nullable();
            $table->boolean('is_publish')->nullable()->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
