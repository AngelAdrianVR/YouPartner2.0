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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('title');
            $table->date('limit_date');
            $table->enum('priority', ['Normal', 'Urgente']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('school_subject_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
