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
        Schema::create('rows', function (Blueprint $table) {
        $table->id();
        $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
        $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
        $table->string('title')->nullable();
        $table->text('description')->nullable();
        $table->integer('order')->default(0);
        $table->string('image')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rows');
    }
};
