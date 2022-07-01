<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id_rechage');
            $table->integer('id_client')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('code', 10);
            $table->date('date');
            $table->string('communication_channel', 300);
            $table->string('payment_method', 300);
            $table->string('payment_reference', 300);
            $table->string('bank', 300);
            $table->string('file', 300);
            $table->string('observation', 500);
            $table->string('coin', 10);
            $table->decimal('amount', 10,2);
            $table->integer('state');
            $table->timestamps();
            $table->foreign('id_client')->references('id_client')->on('clients');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recharge');
    }
}
