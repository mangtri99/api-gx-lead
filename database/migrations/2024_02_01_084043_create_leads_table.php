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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->foreignId('probability_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->foreignId('channel_id')->constrained();
            $table->foreignId('media_id')->nullable()->constrained();
            $table->foreignId('source_id')->nullable()->constrained();
            $table->string('lead_number')->unique();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('company_name');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
