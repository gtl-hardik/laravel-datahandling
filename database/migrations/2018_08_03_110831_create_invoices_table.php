<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller')->nullable();
            $table->string('info',600)->nullable();
            $table->integer('date');
            $table->dateTime('dueDate')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('sent')->nullable();
            $table->integer('client_type');
            $table->string('refNumber',255)->nullable();
            $table->string('companyId',255)->nullable();
            $table->string('finvoiceAddress',255)->nullable();
            $table->string('finvoiceOperator',255)->nullable();
            $table->string('companyName',255)->nullable();
            $table->string('contactPerson',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('postNumber',255)->nullable();
            $table->string('postPlace',255)->nullable();
            $table->string('address1',255)->nullable();
            $table->string('address2',255)->nullable();
            $table->string('country',255)->nullable();
            $table->integer(' paymentMethod');
            $table->string('refOwn',255)->nullable();
            $table->string('refClient',35);
            $table->string('desc',600);
            $table->string('barcode',150);
            $table->string('filename',255);
            $table->decimal('total',9,2)->nullable();
            $table->string('industry',5);
            $table->integer('deliveryMethod')->nullable();
            $table->integer('draft')->nullable();
            $table->integer('discarded');
            $table->integer('status');
            $table->dateTime('received')->nullable();
            $table->dateTime(' modified')->nullable();
            $table->integer('invoiceNumber')->nullable();

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
        Schema::dropIfExists('invoices');
    }
}
