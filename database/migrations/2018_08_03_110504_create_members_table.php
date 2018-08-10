<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('mark_name',255)->nullable();
            $table->string('phone',15);
            $table->string('profession',255);
            $table->string('street_addr',255)->nullable();
            $table->string('zip',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('tax_id',255)->nullable();
            $table->decimal('tax_percent',4,2)->nullable();
            $table->decimal('tax_extra_percent',10,2)->nullable();
            $table->integer('tax_deduction_card')->nullable();
            $table->integer('tax_deduction_card_type')->nullable();
            $table->date('tax_deduction_card_valid_till')->nullable();
            $table->decimal('earnings_limit',10,2)->nullable();
            $table->decimal('foreclosure_percent',4,2)->nullable();
            $table->decimal('fixed_commission',10,2)->nullable();
            $table->integer('autopay')->nullable();
            $table->dateTime('created')->nullable();
            $table->integer('disabled');
            $table->integer('activated');
            $table->string('utmcsr',150)->nullable();
            $table->string('utmccn',150)->nullable();
            $table->string('utmcmd',150)->nullable();
            $table->string('utmctr',150)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('members');
    }
}
