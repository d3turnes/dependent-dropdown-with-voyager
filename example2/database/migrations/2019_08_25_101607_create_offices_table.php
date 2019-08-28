<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 161);
			$table->string('slug', 161)->unique();
			$table->string('address', 161);
			$table->float('lat', 10, 6);
			$table->float('lng', 10, 6);
			$table->unsignedInteger('city_id')->nullable();
            
			/** foreign key */
			$table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
