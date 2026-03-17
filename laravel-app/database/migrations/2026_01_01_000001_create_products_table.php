<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('code')->unique();
            $table->string('image', 100);
            $table->string('brand', 60);
            $table->string('model', 120);
            $table->string('series', 120)->nullable();
            $table->string('category', 40)->index();
            $table->string('type', 40)->nullable();
            $table->string('color', 40)->nullable();
            $table->json('specs')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
