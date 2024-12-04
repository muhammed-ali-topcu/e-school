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
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Grade::class);
//            $table->dropForeign(['grade_id']); // Drop the foreign key first
//            $table->dropColumn('grade_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Grade::class)->nullable()->constrained();
        });
    }
};
