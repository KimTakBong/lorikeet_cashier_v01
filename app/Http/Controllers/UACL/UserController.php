<?php
namespace App\Http\Controllers\UACL;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usergroup;
use Auth, Redirect, Input, Validator, Hash, Crypt, File;

class UserController extends Controller
{
	
	function __construct()
	{
		$this->auth = Auth::user();
	}

	public function getIndex()
	{
		$data ['me'] 			= $this->auth;
		$data ['title']			= "Lorikeet | User Management";
		$data ['usergroup']		= Usergroup::all();
		$data ['count_group']	= count($data['usergroup']);
		$data ['role']	 		= json_decode($this->auth->usergroup->access_right);

		return view( 'admin.uacl.user.index', $data );
	}

	public function getCreate()
	{
		$data ['usergroup']		= Usergroup::all();
		$data ['count_group']	= count($data['usergroup']);
		$html = view( 'admin.uacl.user.modal.create', $data)->render();
		
		return $html;
	}

	public function getUpdate( $id_encrypted )
	{
		$id = Crypt::decrypt( $id_encrypted );

		$data ['user'] 			= User::find( $id );
		$data ['usergroup']		= Usergroup::all();
		$data ['count_group']	= count($data['usergroup']);
		$html = view( 'admin.uacl.user.modal.update', $data)->render();
		
		return $html;
	}

	public function getDelete( $id_encrypted )
	{
		$id = Crypt::decrypt( $id_encrypted );

		$data ['user'] 			= User::find( $id );
		$html = view( 'admin.uacl.user.modal.delete', $data)->render();
		
		return $html;
	}

	public function postCreate()
	{
		$input = Input::all();
		$file  = Input::file('avatar');
		$rules = [
			'usergroup'				=> 'required',
			'name'				 	=> 'required',
			'email'				 	=> 'required|email|unique:users,email',
			'password' 			 	=> 'required',
			'password_confirmation' => 'required|same:password' 
		];

		$validator = Validator::make( $input, $rules );
		if( $validator->passes() ){
			if ( $file ) {
				$destinationPath = public_path().'/uploads';
			    $filename 		 = str_random(10).$file->getClientOriginalName();
			    $upload_success  = $file->move($destinationPath, $filename);
				unset( $input['password_confirmation'] );
				$avatar = 'uploads/'.$filename;
			} else {
				$avatar = null;
			}
			
			$save = new User;
			$save->group_id 	= $input['usergroup'];
			$save->name 		= $input['name'];
			$save->email 		= $input['email'];
			$save->avatar 		= $avatar;
			$save->password 	= Hash::make($input['password']);
			$save->save();

			return Redirect::to( route( 'uacl.user.index' ) );
		} else {
        	$messages = $validator->messages();

			return Redirect::to( route( 'uacl.user.index' ) )
					->withInput( $input )
					->withErrors( $validator );
		}

	}
	
	public function postUpdate($id_encrypted)
	{
		$id = Crypt::decrypt($id_encrypted);
		$input = Input::all();
		$file  = Input::file('avatar');

		$rules = [
			'name'				 	=> 'required',
			'email'				 	=> 'required|email'
		];

		$validator = Validator::make( $input, $rules );
		if( $validator->passes() ){

			if ( isset($input['avatar']) ) {
				$user = User::find($id);
				File::delete( $user->avatar );
				$destinationPath = public_path().'/uploads';
			    // $filename 		 = str_random(10).$file->getClientOriginalName();
			    $filename 		 = $input['name'].'-avatar.png';
			    $upload_success  = $file->move($destinationPath, $filename);
			}
			unset( $input['password_confirmation'] );

			$save = User::find($id);
			$save->group_id = (isset($input['usergroup']))?$input['usergroup']:$save->group_id;
			$save->name = $input['name'];
			$save->email = $input['email'];
			$save->avatar = ( isset($input['avatar']) ) ? 'uploads/'.$filename : $save->avatar;
			$save->password = ( $input['password'] ) ? Hash::make($input['password']) : $save->password;
			$save->save();

			return Redirect::back();

		} else {
			$messages = $validator->messages();

			return Redirect::to( route( 'uacl.user.index' ) )
					->withInput( $input )
					->withErrors( $validator );
		}

	} 


	public function doDelete($id_encrypted)
	{
		$id 	= Crypt::decrypt($id_encrypted);
		$user = User::find($id);
		if ( $user->avatar != null ) {
			File::delete( $user->avatar );
		}
		$user->delete();

  		return Redirect::back();
	}

	public function postRegister(){
		$input = Input::all();
		$input['group_id']  = 3;
		$input['is_active']	= 'active';
		$input['password']	= Hash::make($input['password']);

		User::create( $input );
		
		return Redirect::to( url('auth/login') );
	}
}