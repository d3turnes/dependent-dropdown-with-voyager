<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
	/**
	 *
	 *	return [
	 *		'subcategory_id' => xxx,
	 *		'family_id' => yyy
	 *	]
	 *
	 */
	public static function subcategoryIdRelationship($id) {
		
		return 
			self::where('products.id', '=', $id)
				->select('products.subcategory_id', 'families.id as family_id')
					->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
						->join('families', 'subcategories.family_id', '=', 'families.id')
							->first();
	}
	
}
