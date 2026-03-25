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
        Schema::table('programs', function (Blueprint $table) {
            // Make institution_id nullable — work programs are country-only
            $table->foreignId('institution_id')->nullable()->change();
            // Country target for work programs
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete()->after('institution_id');
            // Work eligibility / requirements (bullet list, one per line)
            $table->text('criteria')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['destination_id']);
            $table->dropColumn(['destination_id', 'criteria']);
            $table->foreignId('institution_id')->nullable(false)->change();
        });
    }
};
