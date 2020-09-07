<?php
namespace App\Http\Controllers\UACL;

use App\Http\Controllers\Controller;
use Auth, Redirect, Input, Validator, Hash, Crypt;
use App\Models\User;
use App\Models\Usergroup;

class GroupController extends Controller
{
	
	function __construct()
	{
		$this->auth = Auth::user();
	}

	public function access( $input ){
		$access = array(
	        'station'   => array(
	        	'c' => ( isset($input['station-c']) ) ? true : false,
	        	'r' => ( isset($input['station-r']) ) ? true : false,
	        	'u' => ( isset($input['station-u']) ) ? true : false,
	        	'd' => ( isset($input['station-d']) ) ? true : false
	        ),
	        'group' => array(
	        	'c' => ( isset($input['group-c']) ) ? true : false,
	        	'r' => ( isset($input['group-r']) ) ? true : false,
	        	'u' => ( isset($input['group-u']) ) ? true : false,
	        	'd' => ( isset($input['group-d']) ) ? true : false
	        ),
	      	'user'  => array(
	            'c' => ( isset($input['user-c']) ) ? true : false,
	            'r' => ( isset($input['user-r']) ) ? true : false,
	            'u' => ( isset($input['user-u']) ) ? true : false,
	            'd' => ( isset($input['user-d']) ) ? true : false
	      	)
	    );

		return json_encode( $access );
	}

	public function getIndex(){
		$data ['me'] 			= $this->auth;
		$data ['title']			= "Lorikeet | Group Management";
		$data ['usergroup']		= Usergroup::all();
		$data ['role']	 		= json_decode($this->auth->usergroup->access_right);
		
		return view( 'admin.uacl.group.index', $data );
	}

	public function getCreate(){
		$html = view( 'admin.uacl.group.modal.create')->render();
		
		return $html;
	}

	public function getUpdate($id_encrypted){
		$id = Crypt::decrypt( $id_encrypted );
		$data['group'] = Usergroup::find( $id );
		$data['group']->access_right = json_decode( $data['group']['access_right'] );

		$html = view( 'admin.uacl.group.modal.update', $data)->render();
		
		return $html;
	}

	public function getDelete($id_encrypted){
		$id = Crypt::decrypt( $id_encrypted );
		$data['group'] = Usergroup::find( $id );

		$html = view( 'admin.uacl.group.modal.delete', $data)->render();
		
		return $html;
	}

	public function postCreate(){
		$input = Input::all();

		$rules = [
			'name'	=> 'required',
		];

		$validator = Validator::make( $input, $rules );
		if( $validator->passes() ){
			$input['access_right'] = $this->access( $input );
			$group = Usergroup::create( $input );

			return Redirect::back();
		} else {
        	$messages = $validator->messages();

			return Redirect::to()
					->withInput( $input )
					->withErrors( $validator );
		}
	}

	public function postUpdate( $id_encrypted ){
		$id 	= Crypt::decrypt( $id_encrypted );
		$input 	= Input::all();

		$rules = [
			'name'	=> 'required',
		];

		$validator = Validator::make( $input, $rules );
		if( $validator->passes() ){
			$group = Usergroup::find( $id );
			$group->name 		 = $input['name'];
			$group->access_right = $this->access( $input );
			$group->save();

			return Redirect::back();
		} else {
        	$messages = $validator->messages();

			return Redirect::to()
					->withInput( $input )
					->withErrors( $validator );
		}
	}

	public function doDelete($id_encrypted){
		$id = Crypt::decrypt($id_encrypted);
		$delete = Usergroup::find($id);
		$delete->delete();

		return Redirect::back();
	}
}