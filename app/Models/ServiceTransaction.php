<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTransaction extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'service_transaction';

	protected $fillable = [
		'service_id',
		'quantity',
		'discount',
		'total_price'
	];

	public $timestamps = true;
}
