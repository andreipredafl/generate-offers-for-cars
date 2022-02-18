<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('offer_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
