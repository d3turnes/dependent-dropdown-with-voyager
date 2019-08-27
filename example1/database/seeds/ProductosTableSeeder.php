<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class ProductosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('productos')->delete();
		
	\DB::table('productos')->insert([
		'name' => 'Jerseys Rojo para hombre',
                'slug' => 'jerseys-rojo-para-hombre',
                'price' => 10.9,
                'desc' => 'Jersey Rojo para Hombre, Talla XL',
                'subcategoria_id' => 4
         ]);
        
	/** check menu_item */
	$products = \DB::table('menu_item')->where('title', '=', 'Productos')->first();
	if (is_null($products)) {
		\DB::table('menu_items')->insert([
			'menu_id' => 1,
			'title' => 'Productos',
			'url' => '',
			'target' => '_self',
			'icon_class' => 'voyager-list',
			'color' => '#000000',
			'parent_id' => NULL,
			'order' => 15,
			'route' => 'voyager.productos.index',
			'parameters' => 'null'
		]);
	}
		
	/** data_type */
	$type = \DB::table('data_types')->where('slug', '=', 'productos')->first();
	if (is_null($type)) {
		$type = \DB::table('data_types')->insert([
			'name' => 'productos',
			'slug' => 'productos',
			'display_name_singular' => 'Producto',
			'display_name_plural' => 'Productos',
			'icon' => 'voyager-list',
			'model_name' => 'App\\Producto',
			'policy_name' => NULL,
			'controller' => NULL,
			'description' => NULL,
			'generate_permissions' => 1,
			'server_side' => 0,
			'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
		]);
	}
	
	//Permissions
        Permission::generateFor('productos');
		
	/** data_rows */
        $data_type_id = $type->id;
	\DB::table('data_rows')->insert(
	     [
		'data_type_id' => $data_type_id,
                'field' => 'id',
                'type' => 'text',
                'display_name' => 'Id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{}',
                'order' => 1,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'name',
                'type' => 'text',
                'display_name' => 'Name',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required"}}',
                'order' => 2,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'slug',
                'type' => 'text',
                'display_name' => 'Slug',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"slugify":{"origin":"name","forceUpdate":true},"validation":{"rule":"required|unique:productos"}}',
                'order' => 3,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'price',
                'type' => 'text',
                'display_name' => 'Price',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required|numeric"}}',
                'order' => 4,
            ],
            [
                'data_type_id' => 8,
                'field' => 'desc',
                'type' => 'text_area',
                'display_name' => 'Desc',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 5,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'subcategoria_id',
                'type' => 'select_dependent_dropdown',
                'display_name' => 'Subcategory Id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{"model":"App\\\\Categoria","name":"categoria_id","route":"api.v1.dropdown","display":"Categoria Id","placeholder":"Seleccione una categoría","key":"id","label":"name","dependent_dropdown":[{"model":"App\\\\Subcategoria","name":"subcategoria_id","display":"Subcategoria Id","placeholder":"Seleccione una subcategor\\u00eda","key":"id","label":"name","where":"categoria_id"}],"validation":{"rule":"required|gt:0"}}',
                'order' => 6,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'Created At',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 1,
                'details' => '{}',
                'order' => 8,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'Updated At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{}',
                'order' => 9,
            ],
            [
                'data_type_id' => $data_type_id,
                'field' => 'producto_belongsto_subcategoria_relationship',
                'type' => 'relationship',
                'display_name' => 'subcategorias',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Subcategoria","table":"subcategorias","type":"belongsTo","column":"subcategoria_id","key":"id","label":"name","pivot_table":"categorias","pivot":"0","taggable":"0"}',
                'order' => 7,
            ],
	]);
		
	/** Generate permision role */
	$this->call(PermissionRoleTableSeeder::class);
    }
}
