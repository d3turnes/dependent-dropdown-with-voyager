<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
		'user_id', 'city_id'
	];
	
	public function user() {
		return $this->belongsTo('App\User');
	}
	
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
			self::where('profiles.id', '=', $id)
				->select('profiles.city_id', 'states.id as state_id', 'countries.id as country_id')
					->join('cities', 'profiles.city_id', '=', 'cities.id')
						->join('states', 'cities.state_id', '=', 'states.id')
							->join('countries', 'states.country_id', '=', 'countries.id')
								->first();
	}
}
