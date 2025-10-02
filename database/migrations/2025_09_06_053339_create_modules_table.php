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
        // laravel crud, laravel crud w api, feature
        Schema::create('module_types', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('module_types')->nullOnDelete();

            $table->dateTime('estimated_duration')->nullable();
            $table->dateTime('total_duration')->nullable();

            $table->decimal('progress', 5, 2)->default(0.00);

            $table->string('status')->default('new'); // new / need-to-discuss / in-development / staged / testing / completed
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
        Schema::dropIfExists('module_types');
    }
};
