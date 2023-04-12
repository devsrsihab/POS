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
        Schema::create('advanced_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employe_id');
            $table->integer('month');
            $table->integer('year');
            $table->integer('advance_salary');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0=Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advanced_salaries');
    }
};