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
        Schema::create('exam_points', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Student::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Exam::class)->constrained()->cascadeOnDelete();
            $table->float('score')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_points');
    }
};
