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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')
            ->constrained('organizations')
            ->onDelete('cascade');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('location', 255);
            $table->dateTime('date');
            $table->enum('status', ['Függőben', 'Megtelt', 'Lezárult'])
            ->default('Függőben');
            $table->integer('capacity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
