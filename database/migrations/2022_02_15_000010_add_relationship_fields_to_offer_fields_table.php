<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOfferFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('offer_fields', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id', 'offer_fk_6003486')->references('id')->on('offers');
            $table->unsignedBigInteger('field_id')->nullable();
            $table->foreign('field_id', 'field_fk_6003487')->references('id')->on('fields');
        });
    }
}
