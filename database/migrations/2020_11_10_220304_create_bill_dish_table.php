<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_dish', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');

            $table->unsignedBigInteger('dish_id')->nullable();  
            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');

            $table->unsignedBigInteger('bill_id')->nullable();  
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            
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
        Schema::dropIfExists('bill_dish');
    }
}
