<?php

use App\Models\ProjectFramework;
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
        Schema::table('module_types', function (Blueprint $table) {
            $table->foreignId('framework_id')
                ->nullable()
                ->constrained('project_frameworks')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_types', function (Blueprint $table) {
            //
        });
    }
};
