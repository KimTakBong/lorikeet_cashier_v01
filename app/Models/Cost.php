<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cost';

	protected $fillable = [
		'name',
		'description',
		'nominal',
		'date'
	];

	public $timestamps = true;
}
