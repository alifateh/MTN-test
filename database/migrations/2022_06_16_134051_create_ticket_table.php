<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ticket', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('UserRef')  //ID User
                ->index('UserRef')
                ->references('UserRef')->on('TUE')->onUpdate('cascade')->onDelete('cascade');

            $table->string('Movie');
            $table->float('Cost');  //Ticket Cost

            $table->integer('TCap')->default(400);

            $table->integer('CCap')
                ->nullable()
                ->default(Null); //Current Reached Capacity

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
        Schema::dropIfExists('Ticket');
    }
}
