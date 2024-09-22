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
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->float('tax');
            $table->date('promise_date');
            $table->date('completed_date')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('payment_released_at')->nullable();
            $table->timestamp('payed_at')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->text('completed_comments')->nullable();
            $table->string('bank_number', 20)->nullable();
            $table->string('bank_name')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('homework_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
