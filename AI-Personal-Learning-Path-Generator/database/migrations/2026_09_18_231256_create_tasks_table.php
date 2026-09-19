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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    	    $table->foreignId('learning_path_id')->nullable()->constrained()->onDelete('cascade');
    	    $table->string('title');
    	    $table->text('description')->nullable();
    	    $table->string('type')->default('learning');
    	    $table->boolean('completed')->default(false);
    	    $table->date('due_date')->nullable();
    	    $table->integer('duration_minutes')->nullable();
   	    $table->timestamps();
        });
  }
  /**     
   * Reverse the migrations.      
   */    
  public function down(): void     
  {  
      Schema::dropIfExists('tasks');     
  } 
}; 
