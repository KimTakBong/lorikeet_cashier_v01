<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\ItemRestock;
use App\Models\ItemTransaction;
use App\Models\Service;
use App\Models\Cost;
use App\Models\ServiceTransaction;
use App\Models\User;
use App\Models\Usergroup;

use Auth, Redirect, Input, Validator, Crypt;

class CafeController extends Controller
{

    function __construct() {
        $this->auth     = Auth::user();
    }

    public function getStock(){
        $data['title']      = "Lorikeet || Product";
        $data['user']       = Auth::user();
        $data['item']		= Item::where( 'visible', 'yes' )->get();
        for ($i=0; $i < count($data['item']); $i++) { 
            $data['item'][$i]->history = ItemRestock::where( 'item_id', $data['item'][$i]->id )->get();
        }
        $data['bin']       = Item::where( 'visible', 'no' )->get();

        return view( 'admin.dashboard.cafe.stock', $data );
    }

    public function getTransaction(){
        $data['title']   = "Lorikeet || Product";
        $data['user']    = Auth::user();
        $data['item']    = Item::where( 'visible', 'yes' )->get();
        // $data['service'] = Service::where( 'visible', 'yes' )->get();
        // $data['staff']   = User::where( 'group_id', Usergroup::where( 'name', 'staff' )->get()[0]->id )->get();
        // dd($data['staff']);
        return view( 'admin.dashboard.cafe.transaction', $data );
    }

    public function getPrint($param=false){
        return view( 'admin.dashboard.cafe.print' );
    }

    public function postTransaction(Request $request ){
        $input = Input::all();
        if ( isset( $input['item_id'] ) || isset( $input['service_id'] ) ) {


            if (isset($input['item_id'])) {
                $input['item_id']            = array_values($input['item_id']);
                $input['quantity_item']      = array_values($input['quantity_item']);
                $input['total_price_item']   = array_values($input['total_price_item']);
                for ($i=0; $i < count( $input['item_id'] ); $i++) { 
                    //set data for ItemTransaction
                    if ($input['quantity_item'][$i]>0) {
                        $transaction['item']['item_id']     = $input['item_id'][$i];
                        $transaction['item']['quantity']    = $input['quantity_item'][$i];
                        // kalo ga input diskon, buat otomatis jadi 0
                        $input['diskon'] = ( $input['diskon'] == "" ) ? 0 : $input['diskon'];
                        $transaction['item']['discount']    = ( $input['total_price_item'][$i] * $input['diskon'] / 100 );
                        $transaction['item']['total_price'] = $input['total_price_item'][$i] - ( $input['total_price_item'][$i] * $input['diskon'] / 100 );
                        
                        //Reduce stock from Item
                        $reduce_stock = Item::find( $transaction['item']['item_id'] );
                        if ($reduce_stock->stock == 0 || $reduce_stock->stock - $transaction['item']['quantity'] < 0) {
                            $request->session()->flash('alert-danger', 'Sorry, Stock not enough !');
                            return Redirect::back();
                        }
                        $reduce_stock->stock -= $transaction['item']['quantity'];
                        $reduce_stock->save();

                        //Create ItemRestock Data for selling
                        $item_restock_suply_data['item_id']     = $transaction['item']['item_id'];
                        $item_restock_suply_data['quantity']    = "-".$transaction['item']['quantity'];
                        $item_restock_suply_data['buying_date'] = date("m/d/Y");
                        ItemRestock::create( $item_restock_suply_data );

                        ItemTransaction::create( $transaction['item'] );
                    }
                }
            }

            if (isset($input['service_id'])) {
                $input['service_id']            = array_values($input['service_id']);
                $input['quantity_service']      = array_values($input['quantity_service']);
                $input['total_price_service']   = array_values($input['total_price_service']);
            
                for ($i=0; $i < count( $input['service_id'] ); $i++) {
                    if ($input['quantity_service'][$i]>0) {
                        $transaction['service']['service_id']  = $input['service_id'][$i];
                        $transaction['service']['quantity']    = $input['quantity_service'][$i];
                        $transaction['service']['discount']    = ( $input['total_price_service'][$i] * $input['diskon'] / 100 );
                        $transaction['service']['total_price'] = $input['total_price_service'][$i] - ( $input['total_price_service'][$i] * $input['diskon'] / 100 );

                        ServiceTransaction::create( $transaction['service'] );
                    }
                }
            }

            $request->session()->flash('alert-success', 'Transaction was successful !');
            return Redirect::back();
        } else {
            $request->session()->flash('alert-danger', 'No item in the cart !');
            return Redirect::back();
        }
    }

    public function addStock( Request $request  ){
        $input  = Input::all();
        $item   = Item::create( $input );

        $request->session()->flash('alert-success', 'Stock was successful added!');
        return Redirect::back();
    }

    public function reStock( Request $request ){
        $input      = Input::all();
        $input['item_id'] = Crypt::decrypt($input['item']);
        unset( $input['item'] );

        $cost = new Cost;
        $item                   = Item::find( $input['item_id'] );
        $restock['item_id']     = $item->id;
        $restock['user_id']     = $this->auth->id;
        $restock['quantity']    = $input['stock'] - $item->stock;
        $restock['buying_price']= $input['buying_price'];
        $restock['buying_date'] = $input['date'];
        if ( $restock['quantity'] >= 0 ) {
            $cost['name']           = "Restock ".($input['stock'] - $item->stock)." Item For ".$item->name;
            $cost['nominal']        = ( $input['stock'] - $item->stock )*$input['buying_price'];
            $cost['description']    = "Buying Price for ".$item->name." per Pcs = Rp.".number_format($input['buying_price']);
            $cost['date']           = $input['date'];
            $cost->save();
            $request->session()->flash('alert-warning', 'Cost for Restock Item was successful created!');
        }

        $item->stock            = $input['stock'];
        $item->save();
        $restock = ItemRestock::create( $restock );

        $request->session()->flash('alert-success', 'Stock was successful updated!');
        return Redirect::back();
    }

    public function postUpdate( $item_id_encrypted, Request $request ){
        $input      = Input::all();
        $input['item_id'] = Crypt::decrypt( $item_id_encrypted );

        $item        = Item::find( $input['item_id'] );
        $item->name  = $input['name'];
        $item->price = $input['price'];
        $item->save();

        $request->session()->flash('alert-success', 'Item was successful updated!');
        return Redirect::back();
    }

    public function doSoftDelete($item_id_encrypted, Request $request ){
        $input['item_id']   = Crypt::decrypt( $item_id_encrypted );
        $item               = Item::find( $input['item_id'] );
        $item->visible      = "no";
        $item->save();

        $request->session()->flash('alert-danger', 'Item was successful deleted!');
        return Redirect::back();
    }

    public function doRestore($item_id_encrypted, Request $request ){
        $input['item_id']   = Crypt::decrypt( $item_id_encrypted );
        $item               = Item::find( $input['item_id'] );
        $item->visible      = "yes";
        $item->save();

        $request->session()->flash('alert-success', 'Item was successful restored!');
        return Redirect::back();
    }

    public function checkStock(){
        $item = Item::find( Crypt::decrypt(Input::get('item_id')) );
        return $item;
    }

    public function deleteHistory($history_id, Request $request){
        $restock_id = Crypt::decrypt( $history_id );

        $history = ItemRestock::find( $restock_id );
        $history->delete();

        $request->session()->flash('alert-warning', 'History was successful deleted!');
        return Redirect::back();
    }

    public function clearHistory($item_id, Request $request){
        $item_id = Crypt::decrypt($item_id);

        $history = ItemRestock::where( 'item_id',$item_id )->get();
        foreach ($history as $data) {
            $data->delete();
        }

        $request->session()->flash('alert-danger', 'History was successful cleared!');
        return Redirect::back();
    }

    
}