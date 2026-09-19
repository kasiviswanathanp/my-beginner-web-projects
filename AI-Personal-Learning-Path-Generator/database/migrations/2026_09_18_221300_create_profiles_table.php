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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
	    $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('learning_goal')->nullable();
            $table->string('current_level')->nullable();
    	    $table->integer('study_hours_per_day')->nullable();
	    $table->text('schedule')->nullable();
	    $table->text('habits')->nullable();
	    $table->text('difficulties')->nullable();
	    $table->text('distractions')->nullable();
	    $table->string('explanation_style')->nullable();
	    $table->string('ui_mood')->nullable();
	    $table->string('checkin_frequency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
