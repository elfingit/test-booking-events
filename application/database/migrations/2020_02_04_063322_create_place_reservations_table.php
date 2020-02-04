<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('company_name');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->text('description')
                ->nullable();

            $table->string('logo_file');

            $table->unsignedBigInteger('place_id')
                  ->unique();

            $table->timestamps();

            $table->foreign('place_id')
                ->on('places')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_reservations');
    }
}
