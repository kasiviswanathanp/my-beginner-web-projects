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
        Schema::create('learning_paths', function (Blueprint $table) {
            $table->id();
	    $table->foreignId('user_id')->constrained()->onDelete('cascade');
	    $table->string('title');
	    $table->text('goal')->nullable();
	    $table->text('description')->nullable();
	    $table->string('current_level')->nullable();
	    $table->integer('progress')->default(0);
	    $table->json('roadmap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_paths');
    }
};
