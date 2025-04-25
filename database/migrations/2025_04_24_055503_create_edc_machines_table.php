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
        Schema::create('edc_machines', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->string('address');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('status')->default('not exist');

            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

   /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edc_machines');
    }
};
