<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuations', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('registration')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('modelYear')->nullable();
            $table->string('transmission')->nullable();
            $table->string('engine_size')->nullable();
            $table->date('first_registration')->nullable();
            $table->string('trim_type')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('color')->nullable();
            $table->string('mileage')->nullable();
            $table->integer('no_of_prev_owner')->nullable();
            $table->string('service_history')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('postcode')->nullable();
            $table->string('valuation')->nullable();
            $table->date('req_collection_date')->nullable();
            $table->time('req_collection_time')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('address_line3')->nullable();
            $table->string('form_type')->comment('1=automatic,2=manual');
            $table->string('status')->nullable()->comment('pending,in-progress,offer-made,accepted,undecided,declined,dealt-needs-delivery,delivery-arranged,delivered,cancelled');
            $table->tinyInteger('assign_to')->nullable()->comment('The ID of the employee to whom this lead is assigned.');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valuations');
    }
}
