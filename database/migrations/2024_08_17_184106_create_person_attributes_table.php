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
        Schema::create('person_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('gender');
            $table->integer('age');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->string('family_history_with_overweight');
            $table->string('favc');
            $table->integer('fcvc');
            $table->integer('ncp');
            $table->string('caec');
            $table->string('smoke');
            $table->integer('ch2o');
            $table->string('scc');
            $table->integer('faf');
            $table->integer('tue');
            $table->string('calc');
            $table->string('mtrans');
            $table->string('nobeyesdad'); // Kolom ini untuk hasil klasifikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_attributes');
    }
};
