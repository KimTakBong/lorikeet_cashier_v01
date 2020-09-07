<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditPayment extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'credit_payment';

	protected $fillable = [
		'credit_master_id',
		'payment_nominal',
		'payment_date'
	];

	public $timestamps = true;
}
