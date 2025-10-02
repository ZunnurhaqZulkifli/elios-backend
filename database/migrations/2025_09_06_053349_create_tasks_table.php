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
        Schema::create('task_types', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        // easy, medium, hard, critical
        Schema::create('task_levels', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('taskable'); // project, module, etc.
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('task_types')->nullOnDelete();
            $table->foreignId('level_id')->nullable()->constrained('task_levels')->nullOnDelete();

            $table->string('title');
            $table->longText('remarks')->nullable();
            $table->string('file_name')->nullable();
            $table->string('assigner')->nullable();

            $table->dateTime('suggested_date')->nullable();
            $table->dateTime('due_date')->nullable();

            $table->boolean('is_completed')->default(false);
            $table->dateTime('completed_at')->nullable();

            $table->decimal('progress', 5, 2)->default(0.00);

            $table->string('status')->default('new'); // new / in-progress / discussed / staged / tested / completed 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_levels');
        Schema::dropIfExists('task_types');
    }
};
