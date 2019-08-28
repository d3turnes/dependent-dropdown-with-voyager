<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

use TCG\Voyager\Models\Permission;

class OfficesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('offices')->delete();
        
        \DB::table('offices')->insert([
            [
                'id' => 1,
				'name' => 'Puerta del Sol',
				'slug' => 'puerta-del-sol',
				'address' => 'Plaza de la Puerta del Sol, 1',
				'lat' => '40.417242',
				'lng' => '-3.702246',
                'city_id' => 2961,
            ],
			[
				'id' => 2,
				'name' => 'Calle Colón',
				'slug' => 'calle-colon',
				'address' => 'Calle Colón, 25',
				'lat' => '39.46903',
				'lng' => '-0.372431',
                'city_id' => 2972,
			]
        ]);
		
		/** check menu_item */
		$offices = \DB::table('menu_items')->where('title', '=', 'Offices')->first();
		if (is_null($offices)) {
			\DB::table('menu_items')->insert([
				'menu_id' => 1,
				'title' => 'Offices',
				'url' => '',
				'target' => '_self',
				'icon_class' => 'voyager-location',
				'color' => '#000000',
				'parent_id' => NULL,
				'order' => 15,
				'created_at' => now(),
				'updated_at' => now(),
				'route' => 'voyager.offices.index'
			]);
		}
		
		/** data_type */
		$type = \DB::table('data_types')->where('slug', '=', 'offices')->first();
		if (is_null($type)) {
			$id = \DB::table('data_types')->insertGetId([
				'name' => 'offices',
				'slug' => 'offices',
				'display_name_singular' => 'Office',
				'display_name_plural' => 'Offices',
				'icon' => 'voyager-location',
				'model_name' => 'App\\Office',
				'policy_name' => NULL,
				'controller' => NULL,
				'description' => NULL,
				'generate_permissions' => 1,
				'server_side' => 0,
				'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}'
			]);
		}
	
		//Permissions
		Permission::generateFor('offices');
        
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
                'delete' => 0,
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
                'delete' => 0,
                'details' => '{"slugify":{"origin":"name","forceUpdate":true},"validation":{"rule":"required|unique:offices"}}',
                'order' => 3,
            ],
			[
				'data_type_id' => $data_type_id,
                'field' => 'address',
                'type' => 'text',
                'display_name' => 'Address',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{}',
                'order' => 4,
            ],
			[
				'data_type_id' => $data_type_id,
                'field' => 'lat',
                'type' => 'text',
                'display_name' => 'Lat',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{"validation":{"rule":"required|numeric"}}',
                'order' => 5,
            ],
			[
				'data_type_id' => $data_type_id,
                'field' => 'lng',
                'type' => 'text',
                'display_name' => 'Long',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{"validation":{"rule":"required|numeric"}}',
                'order' => 6,
            ],
            [
				'data_type_id' => $data_type_id,
                'field' => 'city_id',
                'type' => 'select_dependent_dropdown',
                'display_name' => 'City Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{"model":"App\\\\Country","name":"country_id","route":"api.v1.dropdown","display":"Country","placeholder":"Select a country","key":"id","label":"name","dependent_dropdown":[{"model":"App\\\\State","name":"state_id","display":"State","placeholder":"Select a state","key":"id","label":"name","where":"country_id"},{"model":"App\\\\City","name":"city_id","display":"City","placeholder":"Select a city","key":"id","label":"name","where":"state_id"}],"validation":{"rule":"required|gt:0"}}',
                'order' => 7,
            ],
			[
				'data_type_id' => $data_type_id,
                'field' => 'office_belongsto_city_relationship',
                'type' => 'relationship',
                'display_name' => 'City',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\City","table":"cities","type":"belongsTo","column":"city_id","key":"id","label":"name","pivot_table":"offices","pivot":"0","taggable":"0"}',
                'order' => 8,
            ]
		]);
		
		/** Generate permision role */
		$this->call(PermissionRoleTableSeeder::class);
		
		/** clear cache */
		\Cache::flush();
        
    }
}