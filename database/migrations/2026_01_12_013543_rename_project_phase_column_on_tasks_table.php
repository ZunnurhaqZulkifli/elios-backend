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
        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('project_phase', 'phase');
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->renameColumn('project_phase', 'phase');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('phase', 'project_phase');
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->renameColumn('phase', 'project_phase');
        });
    }
};
