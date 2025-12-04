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
                        Schema::create('acm_services', function (Blueprint $table) {

                        $table->unsignedInteger('service_id')->autoIncrement()->primary(); // Primary Key

                        // Foreign keys must match the parent type (unsignedInteger)
                        $table->unsignedInteger('pro_id');    // FK to acm_products
                        $table->unsignedInteger('ac_id');     // FK to acm_accounts

                        $table->string('service_title');
                        $table->text('service_description');
                        $table->string('service_email');
                        $table->string('service_contact');
                        $table->text('pro_link');
                        $table->unsignedInteger('service_domain');
                        $table->string('service_person', 45);
                        $table->string('service_person_contact', 45);
                        $table->string('service_person2', 45);
                        $table->string('service_person2_contact', 45);
                        $table->string('service_personemail', 45);
                        $table->date('service_start_date');
                        $table->date('service_due_date');
                        $table->integer('service_status')->default(1);
                        $table->integer('service_paid_status')->default(0);

                        $table->timestamps();

                        // Foreign Key Constraints
                        $table->foreign('pro_id')->references('pro_id')->on('acm_products')->onDelete('cascade');
                        $table->foreign('ac_id')->references('ac_id')->on('acm_accounts')->onDelete('cascade');
                    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acm_services');
    }
};
