<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcations', function (Blueprint $table) {
            $table->id();
            $table->string('transcation_type')->default(0)->comment('0 for add_money, 1 for send_money,2 for cash_in,3 for cash_out');
            $table->string('amount')->default(0);
            $table->unsignedBigInteger('sender')->nullable();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('reciver')->nullable();
            $table->foreign('reciver')->references('id')->on('users')->onDelete('cascade');
            $table->string('TXID')->nullable();
            // $table->string('TXID')->uniqid();
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
        Schema::dropIfExists('transcations');
    }
};
