<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('moonshine_user_id')
            ->nullable()
            ->constrained('moonshine_users', 'id')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('cover')->nullable();
            $table->string('author')->nullable()->default('na');
            $table->string('profession')->nullable()->default('na');
            $table->string('title')->nullable()->default('na');
            $table->string('subtile')->nullable()->default('na');
            $table->string('slug')->unique()->nullable();
            $table->longText('summary')->nullable(); // Es para búsquedas (SEO)
            $table->longText('header')->nullable(); // Es para introducción
            $table->longText('content')->nullable(); // Es para contenido
            $table->longText('footer')->nullable(); // Es para conclusión
            $table->string('tags')->nullable();
            $table->json('network_social')->nullable();
            $table->timestamp('published_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP')); // Es para la fecha de publicación
            $table->boolean('is_publish')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
