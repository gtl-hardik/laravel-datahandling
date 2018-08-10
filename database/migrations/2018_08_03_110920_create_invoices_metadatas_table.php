<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_metadatas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key_name',255);
            $table->string('key_value',255);
            $table->integer('invioce_id')->unsigned();
            $table->foreign('invioce_id')->references('id')->on('invoices');
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
        Schema::dropIfExists('invoices_metadatas');
    }
}
