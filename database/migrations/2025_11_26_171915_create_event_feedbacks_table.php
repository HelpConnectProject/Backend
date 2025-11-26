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
        Schema::create('event_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

       
            $table->foreignId('organization_id')
                ->constrained('organizations')
                ->onDelete('cascade');

            $table->foreignId('event_id')
                ->nullable()
                ->constrained('events')
                ->onDelete('set null');

         
            $table->integer('rating');

           
            $table->text('comment');

            
            $table->string('image')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_feedbacks');
    }
};
