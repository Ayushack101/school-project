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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->integer('total_marks');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')
                ->references('id')
                ->on('class_entitys')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
