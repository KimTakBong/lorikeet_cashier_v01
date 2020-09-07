<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usergroups';

	protected $fillable = [ 'name', 'access_right' ];

	public $timestamps = true;

	/**
     * Get the user for the blog post.
     */
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
