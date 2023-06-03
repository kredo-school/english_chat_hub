<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            // FK
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('level_id');

            $table->string('title');
            $table->date('date');                       // only date
            $table->integer('start_at');                // start_at valu indicates frame number ex) 11:00~12:00 === 1, 12:00~13:00 === 2
            $table->integer('status_id')->default(1);   //1:stand by, 2:in sesstion, 3:done

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
