<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTongtinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tongtins', function (Blueprint $table) {
            $table->id();
            $table->date("start_date");
            $table->string("name");
            $table->double("amount")->default(0);
            $table->integer("number_of_play")->default(1);            
            $table->integer("number_of_player")->default(2);            
            $table->integer("status_id")->default(1);
            $table->longtext("description")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tongtins');
    }
}
