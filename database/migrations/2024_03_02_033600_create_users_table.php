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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('middle_name');
            $table->string('surname');
            $table->date('dob');
            $table->foreignId('university_id')->nullable()->constrained()->noActionOnUpdate()->noActionOnDelete();
            $table->timestamps();
            $table->unique(['name', 'middle_name', 'surname', 'dob',]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
