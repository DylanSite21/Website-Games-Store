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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            // Relasi ke users (siapa developernya)
            $table->foreignId('developer_id')->constrained('users')->onDelete('cascade');
            
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2)->default(0);
            
            // 2 Tipe File Media
            $table->string('cover_image')->nullable(); // Path gambar cover
            $table->string('video_trailer')->nullable(); // Path/URL video trailer
            
            $table->enum('status', ['draft', 'published', 'rejected'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
