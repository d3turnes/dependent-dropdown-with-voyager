<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

use TCG\Voyager\Models\Permission;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {
        

		\DB::table('products')->delete();
		
		\DB::table('products')->insert([
			'id' => 1,
			'name' => 'Jerseys Rojo para hombre',
			'slug' => 'jerseys-rojo-para-hombre',
			'price' => 10.9,
			'desc' => 'Jersey Rojo para Hombre, Talla XL',
			'subcategory_id' => 4
		]);
        
		/** check menu_item */
		$products = \DB::table('menu_items')->where('title', '=', 'Products')->first();
		if (is_null($products)) {
			\DB::table('menu_items')->insert([
				'menu_id' => 1,
				'title' => 'Products',
				'url' => '',
				'target' => '_self',
				'icon_class' => 'voyager-list',
				'color' => '#000000',
				'parent_id' => NULL,
				'order' => 15,
				'created_at' => now(),
				'updated_at' => now(),
				'route' => 'voyager.products.index'
			]);
		}
		
		/** data_type */
		$type = \DB::table('data_types')->where('slug', '=', 'products')->first();
		if (is_null($type)) {
			$id = \DB::table('data_types')->insertGetId([
				'name' => 'products',
				'slug' => 'products',
				'display_name_singular' => 'Product',
				'display_name_plural' => 'Products',
				'icon' => 'voyager-list',
				'model_name' => 'App\\Product',
				'policy_name' => NULL,
				'controller' => NULL,
				'description' => NULL,
				'generate_permissions' => 1,
				'server_side' => 0,
				'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}'
			]);
		}
	
		//Permissions
		Permission::generateFor('products');
		
		/** data_rows */
		$data_type_id = isset($type->id) ? $type->id : $id;
		\DB::table('data_rows')->insert([
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
				'order' => 1
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
				'details' => '{"slugify":{"origin":"name","forceUpdate":true},"validation":{"rule":"required|unique:products"}}',
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
				'data_type_id' => $data_type_id,
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
				'field' => 'subcategory_id',
				'type' => 'select_dependent_dropdown',
				'display_name' => 'Subcategory Id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 1,
				'add' => 1,
				'delete' => 0,
				'details' => '{"model":"App\\\\Family","name":"family_id","route":"api.v1.dropdown","display":"Family Id","placeholder":"Seleccione una familia","key":"id","label":"name","dependent_dropdown":[{"model":"App\\\\Subcategory","name":"subcategory_id","display":"Subcategory Id","placeholder":"Seleccione una subcategoría","key":"id","label":"name","where":"family_id"}],"validation":{"rule":"required|gt:0"}}',
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
				'field' => 'product_belongsto_subcategory_relationship',
				'type' => 'relationship',
				'display_name' => 'Subcategories',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '{"model":"App\\\\Subcategory","table":"subcategories","type":"belongsTo","column":"subcategory_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
				'order' => 7,
			]
		]);
		
		/** Generate permision role */
		$this->call(PermissionRoleTableSeeder::class);
		
		/** clear cache */
		\Cache::flush();
    }
}