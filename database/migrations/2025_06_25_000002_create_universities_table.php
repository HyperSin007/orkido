<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('name');
            $table->string('city');
            $table->string('subjects_name');
            $table->string('bachelor')->nullable();
            $table->string('masters')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('tuition_fees')->nullable();
            $table->string('application_fees')->nullable();
            $table->string('requirements')->nullable();
            $table->float('ielts')->nullable();
            $table->string('minimum_cgpa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
