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

                        // Foreign keys - nullable since they're optional now
                        $table->unsignedInteger('pro_id')->nullable();
                        $table->unsignedInteger('ac_id')->nullable();

                        $table->string('service_title');
                        $table->text('service_description')->nullable();
                        $table->string('service_email')->nullable();
                        $table->string('service_contact')->nullable();
                        $table->text('pro_link')->nullable();
                        $table->unsignedInteger('service_domain')->nullable();
                        $table->string('service_person', 45)->nullable();
                        $table->string('service_person_contact', 45)->nullable();
                        $table->string('service_person2', 45)->nullable();
                        $table->string('service_person2_contact', 45)->nullable();
                        $table->string('service_personemail', 45)->nullable();
                        $table->date('service_start_date');
                        $table->date('service_due_date');
                        $table->integer('service_status')->default(1);
                        $table->integer('service_paid_status')->default(0);
                        $table->string('service_additional_detail', 255)->nullable();
                        $table->text('service_db')->nullable();
                        $table->text('service_db_user')->nullable();
                        $table->text('service_db_password')->nullable();

                        $table->timestamps();
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
