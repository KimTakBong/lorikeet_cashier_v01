<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\Service;
use App\Models\ServiceTransaction;
use App\Models\Cost;
use App\Models\User;

use Auth, Redirect, Input, Validator, Crypt;

class LaporanController extends Controller
{

    function __construct() {
        $this->auth     = Auth::user();
    }

    public function getIndex( $send_date = false ){
        $data['title']      = "Lorikeet || Laporan Index";
        $data['user']       = Auth::user();
        $data['item']       = Item::all();
        $data['service']    = Service::all();
        if ( $send_date ) {
            $req_d = explode('-', $send_date);
            $total_days  = cal_days_in_month(CAL_GREGORIAN, $req_d[0], $req_d[1])+1;
        } else {
            $total_days  = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))+1;
        }
        for ($i=1; $i < $total_days; $i++) { 
            $data['income'][$i] = [];
            $data['cost'][$i]   = [];
        }
        $data['table'] = [];
        $data['item_transaction'] = [];
        $data['service_transaction'] = [];
        $i=0;
        foreach ($data['item'] as $item) {
            $item_transaction[$i] = ItemTransaction::where( 'item_id', $item->id )->get()->toArray();
            if (!empty($item_transaction[$i])) {
                array_push($data['item_transaction'], $item_transaction[$i]);
            }
            $i++;
        }
        foreach ($data['service'] as $service) {
            $service_transaction[$i] = ServiceTransaction::where( 'service_id', $service->id )->get()->toArray();
            if (!empty($service_transaction[$i])) {
                array_push($data['service_transaction'], $service_transaction[$i]);
            }
            $i++;
        }

        $data['request_date'] = ($send_date == true )?$send_date:date("m-Y");

        //suply data income from item transaction
        for ($it=0; $it < count($data['item_transaction']); $it++) { 
            for ($itd=0; $itd < count($data['item_transaction'][$it]); $itd++) { 
                $date = explode('-', explode(' ', $data['item_transaction'][$it][$itd]['created_at'])[0]);
                if ( $data['request_date'] == $date[1].'-'.$date[0] ) {
                    array_push($data['income'][(int)$date[2]], $data['item_transaction'][$it][$itd]['total_price']);
                    array_push($data['table'], $data['item_transaction'][$it][$itd]);
                }
            }
        }

        for ($it=0; $it < count($data['service_transaction']); $it++) { 
            for ($itd=0; $itd < count($data['service_transaction'][$it]); $itd++) { 
                $date = explode('-', explode(' ', $data['service_transaction'][$it][$itd]['created_at'])[0]);
                if ( $data['request_date'] == $date[1].'-'.$date[0] ) {
                    array_push($data['income'][(int)$date[2]], $data['service_transaction'][$it][$itd]['total_price']);
                    array_push($data['table'], $data['service_transaction'][$it][$itd]);
                }
            }
        }

        $cost_raw       = Cost::all()->toArray();
        
        //suply data cost from cost
        for ($co=0; $co < count($cost_raw); $co++) {
            $date = explode('/', $cost_raw[$co]['date']);
            if ( $data['request_date'] == $date[0].'-'.$date[2] ) {
                array_push($data['cost'][(int)$date[1]], $cost_raw[$co]['nominal']);
                // array_push($data['table'], $cost_raw[$co]);
            }
        }

        $month        = explode('-', $data['request_date']);
        $day_per_week = [ 
            "Monday"    => [],
            "Tuesday"   => [],
            "Wednesday" => [],
            "Thursday"  => [],
            "Friday"    => [],
            "Saturday"  => [],
            "Sunday"    => [] 
        ];
        for ($i=1; $i < $total_days; $i++) { 
            $data['income'][$i] = array_sum($data['income'][$i]);
            $target = date( 'l', strtotime($month[0].'/'.$i.'/'.$month[1]) );
            array_push( $day_per_week[$target], $data['income'][$i] );
            $data['cost'][$i]   = array_sum($data['cost'][$i]);
        }
        $data['income'] = array_values($data['income']);
        // dd($data['income']);
        $data['cost']   = array_values($data['cost']);
        for ($i=0; $i < 7; $i++) { 
            $data['days_data'][$i] = array_sum($day_per_week[array_keys($day_per_week)[$i]]);
        }

        for ($i=0; $i < 24; $i++) { 
            if (strlen( $i ) == 1) {
                $hour_per_day[ "0".$i.":00 - 0".$i.":59" ] = [];
            } else {
                $hour_per_day[ $i.":00 - ".$i.":59" ] = [];
            }
        }

        for ($i=0; $i < count($data['table']); $i++) { 
            $time = explode(' ', $data['table'][$i]['created_at']);
            $hour = explode(':', $time[1]);

            array_push($hour_per_day[ $hour[0].':00 - '.$hour[0].':59' ], $data['table'][$i]['total_price']);
        }

        $data['hour_per_day'] = array_values($hour_per_day);

        for ($i=0; $i < 24; $i++) { 
            $data['hour_per_day'][$i] = array_sum( $data['hour_per_day'][$i] );
        }

        return view( 'admin.dashboard.laporan.index', $data );
    }

    public function getDetail(){
        $data['input'] = Input::all();
        $date = explode('/', $data['input']['date']);
        for ($i=0; $i < count($date); $i++) { 
            if( strlen( $date[$i] ) == 1 ){
                $date[$i] = '0'.$date[$i];
            }
        }
        $income = [];

        if ( $data['input']['status'] == 'income' ) {
            $data['item']     = ItemTransaction::join('item', 'item_transaction.item_id', '=', 'item.id')
                                    ->whereBetween( 'item_transaction.created_at', [ $date[2].'-'.$date[1].'-'.$date[0].' 00:00:00', $date[2].'-'.$date[1].'-'.$date[0].' 23:59:59' ]  )
                                    ->select('item.name', 'item_transaction.quantity', 'item_transaction.total_price')
                                    ->get()->toArray();
            $data['service']  = ServiceTransaction::join('service', 'service_transaction.service_id', '=', 'service.id')
                                    ->whereBetween( 'service_transaction.created_at', [ $date[2].'-'.$date[1].'-'.$date[0].' 00:00:00', $date[2].'-'.$date[1].'-'.$date[0].' 23:59:59' ]  )
                                    ->select('service.name', 'service_transaction.quantity', 'service_transaction.total_price')
                                    ->get()->toArray();

            for ($i=0; $i < count($data['item']); $i++) {
                array_push($income, $data['item'][$i]);
            }
            for ($i=0; $i < count($data['service']); $i++) {
                array_push($income, $data['service'][$i]);
            }

            $data['income'] = array();
            foreach($income as $ar){
                foreach($ar as $k => $v){
                    if(array_key_exists($v, $data['income'])){
                        $data['income'][$v]['quantity']     = $data['income'][$v]['quantity'] + $ar['quantity'];
                        $data['income'][$v]['total_price']  = $data['income'][$v]['total_price'] + $ar['total_price'];
                    } elseif($k == 'name'){
                        $data['income'][$v] = $ar;
                    }
                }
            }
            $data['income'] = array_values( $data['income'] );
        } else {
            $data['cost']     = Cost::where( 'date', $date[1].'/'.$date[0].'/'.$date[2] )->get()->toArray();
        }

        $html = view( 'admin.dashboard.laporan.detail', $data)->render();
        return $html;
    }

    function searchName($name, $array) {
        foreach ($array as $key => $val) {
            if ($val['name'] === $name) {
                return $key;
            }
        }
        return null;
    }
}