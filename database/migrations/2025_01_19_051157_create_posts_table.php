<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('moonshine_user_id')
            ->nullable()
            ->constrained('moonshine_users', 'id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('cover')->nullable()->default('na');
            $table->string('title')->nullable()->default('na');
            $table->string('slug')->nullable()->unique()->default('na');
            $table->string('subtitle')->nullable()->default('na');
            $table->string('author')->nullable()->default('na');
            $table->string('tags')->nullable()->default('na');
            $table->json('network_social')->nullable();
            $table->timestamp('date_published', 0)->nullable()->default(DB::raw('CURRENT_TIMESTAMP')); // fecha de inicio (recoger)
            $table->text('summary')->nullable();
            $table->text('header')->nullable();
            $table->text('content')->nullable();
            $table->text('footer')->nullable();
            $table->boolean('published')->nullable()->default(false);
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
