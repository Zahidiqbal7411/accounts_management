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
        Schema::create('acm_service_histories', function (Blueprint $table) {
                   

                 $table->unsignedInteger('history_id')->autoIncrement()->primary();

           
                    $table->unsignedInteger('service_id');   

                    $table->foreign('service_id')
                        ->references('service_id')
                        ->on('acm_services')
                        ->onDelete('cascade');

                    $table->date('current_date');
                    $table->date('current_due_date');
                    $table->date('next_due_date');

                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acm_service_histories');
    }
};
