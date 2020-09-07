<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditUser extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'credit_user';

	protected $fillable = [
		'user_id',
		'id_card_type', // KTP, SIM, Pasport, BPJS, Other
		'id_card_code',
		'id_card_address',
		'phone',
		'other_info'
	];

	public $timestamps = true;
}
