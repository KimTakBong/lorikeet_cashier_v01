<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item_transaction';

	protected $fillable = [
		'item_id',
		'quantity',
		'discount',
		'total_price'
	];

	public $timestamps = true;
}
