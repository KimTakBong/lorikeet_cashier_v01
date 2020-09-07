<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemRestock extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item_restock';

	protected $fillable = [
		'item_id',
		'user_id',
		'quantity',
		'buying_price',
		'buying_date'
	];

	public $timestamps = true;
}
