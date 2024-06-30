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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('mother_name');
            $table->string('father_name');
            $table->integer('rollno')->nullable();
            $table->string('disease_name')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('is_paralysed');
            $table->json('documents_attached');
            $table->string('age_proof')->nullable();
            $table->json('parents_identity_docs');
            $table->string('student_hobby')->nullable();
            $table->string('student_interests')->nullable();
            $table->string('disease')->nullable();
            $table->text('extra_details_of_student')->nullable();
            $table->unsignedBigInteger('admission_class')->nullable();
            $table->foreign('admission_class')->references('id')->on('class_entitys')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('section')->nullable();
            $table->foreign('section')->references('id')->on('sections')->onDelete('set null')->onUpdate('cascade');
            $table->date('dob');
            $table->string('gender');
            $table->float('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('religion');
            $table->string('category');
            $table->text('permanent_address');
            $table->text('postal_address');
            $table->string('phone_no');
            $table->string('alternate_phone_no')->nullable();
            $table->string('area');
            $table->string('fathers_occupation')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->string('bpl_no');
            $table->string('aadhar_card_student');
            $table->string('aadhar_card_parent');
            $table->string('bank_account_no');
            $table->string('ifsc_code');
            $table->string('email')->unique()->nullable();
            $table->string('native_language')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('gurdian_name')->nullable();
            $table->string('admission_no');
            $table->date('admission_date');
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
