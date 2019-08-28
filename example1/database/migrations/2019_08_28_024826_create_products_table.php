<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 161);
			$table->string('slug', 161)->unique();
			$table->float('price');
			$table->text('desc')->nullable();
			$table->unsignedInteger('subcategory_id');
			$table->timestamps();
			
			/** foreign key */
			$table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
		
		\DB::table('families')->insert([
			['id' => 1, 'name' => 'T Shirts', 'slug' => 't-shirts'],
			['id' => 2, 'name' => 'Jerseys', 'slug' => 'jerseys'],
			['id' => 3, 'name' => 'Pants', 'slug' => 'pants']
		]);
		
		\DB::table('subcategories')->insert([
			['id' => 1, 'name' => 'Red T Shirts', 'slug' => 'red-t-shirts', 'family_id' => 1],
			['id' => 2, 'name' => 'Blue T Shirts', 'slug' => 'blue-t-shirts', 'family_id' => 1],
			['id' => 3, 'name' => 'Women T Shirts', 'slug' => 'women-t-shirts', 'family_id' => 1],
			['id' => 4, 'name' => 'Men Red Jerseys', 'slug' => 'men-red-jerseys', 'family_id' => 2],
			['id' => 5, 'name' => 'Men Blue Jerseys', 'slug' => 'men-blue-jerseys', 'family_id' => 2],
			['id' => 6, 'name' => 'Women Pants', 'slug' => 'women-pants', 'family_id' => 3],
			['id' => 7, 'name' => 'Men Pants', 'slug' => 'men-pants', 'family_id' => 3]
		]);
		
		\DB::table('products')->insert([
			['id' => 1, 'name' => 'Product One', 'slug' => 'product-one', 'price' => 10.90, 'subcategory_id' => 1],
			['id' => 2, 'name' => 'Product Two', 'slug' => 'product-two', 'price' => 9.90, 'subcategory_id' => 2],
			['id' => 3, 'name' => 'Women Pants', 'slug' => 'women-pants', 'price' => 8.95, 'subcategory_id' => 6]
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
