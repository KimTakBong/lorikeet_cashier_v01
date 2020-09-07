<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'service';

	protected $fillable = [
		'name',
		'price',
		'visible'
	];

	public $timestamps = true;
}
