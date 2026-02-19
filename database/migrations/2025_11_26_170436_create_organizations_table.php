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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->enum('category', [
                'Szociális és humanitárius szervezetek',
                'Egészségügyi szervezetek',
                'Oktatási és tudományos szervezetek',
                'Környezetvédelmi szervezetek',
                'Emberi jogi és jogvédő szervezetek',
                'Kulturális és művészeti szervezetek',
                'Sport és szabadidős szervezetek',
                'Ifjúsági és közösségfejlesztő szervezetek',
                'Érdekvédelmi és szakmai szervezetek',
            ]);
            $table->string('phone', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('website', 100)->nullable();
            $table->string('bank_account', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
