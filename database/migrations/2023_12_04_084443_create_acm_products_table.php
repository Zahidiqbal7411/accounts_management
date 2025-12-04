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
                    Schema::create('acm_products', function (Blueprint $table) {

                    $table->unsignedInteger('pro_id')->autoIncrement()->primary();   // INT(10)
                    
                    $table->string('pro_title');                          // VARCHAR(255)
                    $table->text('pro_description');                      // TEXT
                    $table->date('pro_expiry_date');                           // DATE
                    
                    $table->timestamps();
                });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acm_products');
    }
};
