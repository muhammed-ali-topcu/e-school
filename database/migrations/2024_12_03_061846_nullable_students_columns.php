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

        Schema::table('students', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->change();
            $table->date('enrollment_date')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('guardian_name')->nullable()->change();
            $table->string('guardian_phone')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date('birth_date')->change();
            $table->date('enrollment_date')->change();
            $table->string('phone')->change();
            $table->string('guardian_name')->change();
            $table->string('guardian_phone')->change();
        });
    }
};
