<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTUETable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TUE', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('UserRef')  //ID User
                ->index()
                ->references('id')->on('Users')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('TicketRef')
                ->references('id')->on('Ticket')->onUpdate('cascade')->onDelete('cascade'); //ID ticket

            $table->float('Cost');  //Ticket Cost

            $table->integer('TCap')
                ->references('TCap')->on('Ticket')->onUpdate('cascade')->onDelete('cascade'); //Capacity of the ticket

            $table->integer('CCap')
                ->references('CCap')->on('TUE')->onUpdate('cascade')->onDelete('cascade'); //Current Reached Capacity

            $table->float('Vat');  //Cost*1.09
            $table->float('ToCost');  //Total Paid Cost till this transaction
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
        Schema::dropIfExists('TUE');
    }
}
