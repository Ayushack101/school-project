<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_entitys', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 500)->unique();
            $table->string('numeric_name', 500)->unique();
            $table->integer('monthly_fee');
            $table->integer('development_fee');
            $table->integer('exam_fee');
            $table->integer('extra_activities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_entitys');
    }
};
