<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('profiles')->delete();
        
        \DB::table('profiles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'city_id' => 1737,
                'created_at' => '2019-08-25 12:42:47',
                'updated_at' => '2019-08-26 11:55:12',
            ],
        ]);
        
        
    }
}