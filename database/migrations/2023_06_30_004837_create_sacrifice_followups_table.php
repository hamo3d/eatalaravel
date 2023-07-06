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
        Schema::create('sacrifice_followups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->constrained('donations');
            $table->boolean('slaughtered')->default(false);
            $table->string('note');
            $table->string('documentation_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacrifice_followups');
    }
};
