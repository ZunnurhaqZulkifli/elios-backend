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
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('display_name')->nullable();
            $table->string('email')->unique();
            
            // personal info
            $table->string('title')->default(''); // developer, manager, etc.
            $table->string('position')->default('senior'); // intern, senior, manager, director, executive, etc.
            $table->longText('about')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('postcode')->nullable();

            // timeline purposes
            $table->string('priority')->default('low');

            $table->string('status')->default('unverified');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individuals');
    }
};
