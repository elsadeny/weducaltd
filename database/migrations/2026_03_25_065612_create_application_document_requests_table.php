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
        Schema::create('application_document_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->string('document_type');          // e.g. "Passport", "Payment Slip"
            $table->string('note')->nullable();        // extra instruction for the student
            $table->timestamp('fulfilled_at')->nullable(); // null = pending
            $table->foreignId('document_id')->nullable()->constrained('application_documents')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_document_requests');
    }
};
