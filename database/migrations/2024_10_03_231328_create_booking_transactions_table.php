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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('booking_trx_id');
            $table->string('name');
            $table->string('phone_number');
            $table->boolean('is_paid');
            $table->foreignId('office_space_id')->constrained()->cascadeOnDelete(); 
            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('duration');
            $table->date('started_at');
            $table->date('ended_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
