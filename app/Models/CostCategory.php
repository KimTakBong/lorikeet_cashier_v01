<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCategory extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cost_category';

	protected $fillable = [
		'parent_id',
		'name',
	];

	public $timestamps = true;
}
