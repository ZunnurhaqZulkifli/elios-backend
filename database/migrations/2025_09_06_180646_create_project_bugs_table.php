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
        Schema::create('project_bug_severities', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_bugs', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('buggable'); // project, module, etc.
            $table->foreignId('test_id')->nullable()->constrained('module_tests')->nullOnDelete();
            $table->foreignId('discovered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('severity_id')->nullable()->constrained('project_bug_severities')->nullOnDelete();
            
            $table->string('title');
            $table->string('image')->nullable();
            $table->dateTime('discovered_at')->nullable();

            $table->string('status')->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_bugs');
        Schema::dropIfExists('project_bug_severities');
    }
};
