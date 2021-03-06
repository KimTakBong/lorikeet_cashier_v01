<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cost;

use Auth, Redirect, Input, Validator, Crypt;

class CostController extends Controller
{
    function __construct() {
        $this->auth     = Auth::user();
    }

    public function getIndex(){
        $data['title']      = "Lorikeet || Cost Management";
        $data['user']       = Auth::user();
        $data['cost']		= Cost::all();
        // dd($data);
        return view( 'admin.dashboard.cost.index', $data );
    }

    public function postCreate( Request $request ){
    	$input 		= Input::all();

    	Cost::create($input);

        $request->session()->flash('alert-success', 'Cost was successful added!');
    	return Redirect::back();
    }

    public function doDelete($cost_id_encrypted, Request $request ){
    	$cost_id   = Crypt::decrypt( $cost_id_encrypted );
    	$cost      = Cost::find($cost_id);
    	$cost->delete();

        $request->session()->flash('alert-danger', 'Cost was successful deleted!');
    	return Redirect::back();
    }
}