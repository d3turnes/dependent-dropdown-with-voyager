<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
		'name', 'slug', 'address', 'lat', 'lng', 'city_id'
	];
	
	public $timestamps = false;
	
	public function city() {
		return $this->belongsTo('App\City');
	}
	
	/**
	 *
	 *	return [
	 *		'city_id' => xxx,
	 *		'state_id' => yyy
	 *		'country_id' => zzz
	 *	]
	 *
	 */
	public static function cityIdRelationship($id) {
		
		return 
			self::where('offices.id', '=', $id)
				->select('offices.city_id', 'states.id as state_id', 'countries.id as country_id')
					->join('cities', 'offices.city_id', '=', 'cities.id')
						->join('states', 'cities.state_id', '=', 'states.id')
							->join('countries', 'states.country_id', '=', 'countries.id')
								->first();
	}
}
