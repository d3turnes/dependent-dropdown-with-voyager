<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
	/**
	 *
	 *	return [
	 *		'subcategoria_id' => xxx,
	 *		'categoria_id' => yyy
	 *	]
	 *
	 */
	public static function subcategoriaIdRelationship($id) {
		
		return 
			self::where('productos.id', '=', $id)
				->select('productos.subcategoria_id', 'categorias.id as categoria_id')
					->join('subcategorias', 'productos.subcategoria_id', '=', 'subcategorias.id')
						->join('categorias', 'subcategorias.categoria_id', '=', 'categorias.id')
							->first();
	}
	
}
