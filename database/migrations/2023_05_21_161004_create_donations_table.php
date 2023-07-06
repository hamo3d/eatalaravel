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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',8,2)->default(0);
            $table->integer('donations_type');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns');
            $table->integer('quantity')->nullable();
            $table->string('item')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation');
    }
};
