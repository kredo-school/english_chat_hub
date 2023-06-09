<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // FK
            $table->unsignedBigInteger('subtitle_id');
            
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->text('content');
            $table->integer('status_id')->default(1); //1:not started, 2:in progress, 3:done
            $table->timestamps();

            $table->foreign('subtitle_id')->references('id')->on('subtitles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
