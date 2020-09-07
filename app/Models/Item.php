<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item';

	protected $fillable = [
		'name',
		'type',
		'price',
		'stock',
		'visible'
	];

	public $timestamps = true;
}
