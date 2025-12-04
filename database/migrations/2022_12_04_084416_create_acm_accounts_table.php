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
        Schema::create('acm_accounts', function (Blueprint $table) {
            $table->increments('ac_id'); // INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('ac_title');
            $table->string('ac_owner', 45);
            $table->string('ac_contact', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acm_accounts');
    }
};
