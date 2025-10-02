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
        // new / up
        Schema::create('module_test_types', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(1.00);

            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('module_tests', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('testable'); // project, module, etc.
            $table->foreignId('tester_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('module_test_types')->nullOnDelete();

            $table->string('title');
            $table->longText('remarks')->nullable();
            $table->boolean('tested')->default(false);
            
            $table->dateTime('tested_at')->nullable();
            
            $table->string('status')->default('testing'); // testing / fixing / passed / failed
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_tests');
        Schema::dropIfExists('module_test_types');
    }
};
