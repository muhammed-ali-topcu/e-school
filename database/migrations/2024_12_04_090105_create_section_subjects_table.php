<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('section_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Section::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Subject::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Teacher::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\AcademicYear::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_subjects');
    }
};