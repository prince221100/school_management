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
        Schema::create('class_datas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('class_name');
            $table->unsignedBigInteger('subject_name');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('class_name')->references('id')->on('class_infos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_name')->references('id')->on('subject_infos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_datas');
    }
};
