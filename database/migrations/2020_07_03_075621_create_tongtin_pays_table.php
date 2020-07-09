<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTongtinPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tongtin_pays', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->integer("tongtin_id");
            $table->integer("number_of_claim")->default(1);
            $table->double('amount');
            $table->double('total_amount');
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
        Schema::dropIfExists('tongtin_pays');
    }
}
