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
        // e.g., work, personal, hobby, etc.
        Schema::create('project_types', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        // e.g., frontend, backend, design, marketing, etc.
        Schema::create('project_categories', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->nullableMorphs('ownerable');
            $table->foreignId('type_id')->nullable()->constrained('project_types')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('project_categories')->nullOnDelete();

            $table->string('title');
            $table->longText('description')->nullable();

            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->dateTime('projected_end_at')->nullable();

            $table->string('status')->default('new');
            $table->string('version')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_details', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->longText('details')->nullable();
            $table->decimal('budget', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_categories');
        Schema::dropIfExists('project_types');
    }
};
