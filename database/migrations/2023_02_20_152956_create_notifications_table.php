<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('receiver_id');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_name');
            $table->string('subject');
            $table->string('msg');
            $table->boolean('status')->default(0)->comment('1=Seen,0=Un-Seen');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // agar user_id 0 hai tab sabhi employee ko notification jayenge & in notifications ko only admin delete kar sakta hai.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
