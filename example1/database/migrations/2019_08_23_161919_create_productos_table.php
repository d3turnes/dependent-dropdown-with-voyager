<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 161);
			$table->string('slug', 161)->unique();
			$table->float('price');
			$table->text('desc')->nullable();
			$table->unsignedInteger('subcategoria_id');
			$table->timestamps();
        });
		
		
		\DB::table('categorias')->insert([
			['id' => 1, 'name' => 'T Shirts', 'slug' => 't-shirts'],
			['id' => 2, 'name' => 'Jerseys', 'slug' => 'jerseys'],
			['id' => 3, 'name' => 'Pants', 'slug' => 'pants']
		]);
		
		\DB::table('subcategorias')->insert([
			['id' => 1, 'name' => 'Red T Shirts', 'slug' => 'red-t-shirts', 'categoria_id' => 1],
			['id' => 2, 'name' => 'Blue T Shirts', 'slug' => 'blue-t-shirts', 'categoria_id' => 1],
			['id' => 3, 'name' => 'Women T Shirts', 'slug' => 'women-t-shirts', 'categoria_id' => 1],
			['id' => 4, 'name' => 'Men Red Jerseys', 'slug' => 'men-red-jerseys', 'categoria_id' => 2],
			['id' => 5, 'name' => 'Men Blue Jerseys', 'slug' => 'men-blue-jerseys', 'categoria_id' => 2],
			['id' => 6, 'name' => 'Women Pants', 'slug' => 'women-pants', 'categoria_id' => 3],
			['id' => 7, 'name' => 'Men Pants', 'slug' => 'men-pants', 'categoria_id' => 3]
		]);
		
		\DB::table('productos')->insert([
			['id' => 1, 'name' => 'Product One', 'slug' => 'product-one', 'price' => 10.90, 'subcategoria_id' => 1],
			['id' => 2, 'name' => 'Product Two', 'slug' => 'product-two', 'price' => 9.90, 'subcategoria_id' => 2],
			['id' => 3, 'name' => 'Women Pants', 'slug' => 'women-pants', 'price' => 8.95, 'subcategoria_id' => 6]
		]);
		
		
		
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
