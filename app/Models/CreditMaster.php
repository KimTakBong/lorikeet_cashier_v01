<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditMaster extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'credit_master';

	protected $fillable = [
		'product_id',
		'client_id',
		'tenor_type', // Daily, Weekly, Monthly, 1/Year, Custom Day Range  
		'tenor',
		'dp',
		'credit_interest',
		'admin_fee'
	];

	public $timestamps = true;
}
