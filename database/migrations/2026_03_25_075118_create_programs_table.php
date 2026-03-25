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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('duration')->nullable();   // e.g. "3 years"
            $table->string('fees')->nullable();        // e.g. "$8,000/year"
            $table->string('level')->nullable();       // e.g. Bachelor, Master, Short Course
            $table->string('category')->default('study'); // study | work
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
