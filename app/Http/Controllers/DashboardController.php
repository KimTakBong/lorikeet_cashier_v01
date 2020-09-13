<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Item;
use App\Models\Service;
use App\Models\ItemTransaction;
use App\Models\Cost;
use Carbon\Carbon;

use Auth, Redirect, Input, Crypt;

class DashboardController extends Controller
{

    function __construct() {
        date_default_timezone_set("Asia/Bangkok");
        $this->auth  = Auth::user();
    }

    public function getIndex($today = false){
        $data['dayBuilderData'] = $this->dayBuilder( $today );

        $data['title']      = "Lorikeet || Dashboard";
        $data['user']       = Auth::user();
        $data['role']       = json_decode($this->auth->usergroup->access_right);

        $today = date('Y-m-d');
        $data['today_revenue']      = 0;
        $data['today_cost']         = 0;
        $data['today_item_sold']    = 0;
        $data['today_service_sold'] = 0;
        $transaction['item']    = ItemTransaction::where( 'created_at', '>=', $today.' 00:00:00' )->get()->toArray();
        foreach ($transaction['item'] as $trans_item) {
            $data['today_item_sold']    += $trans_item['quantity'];
            $data['today_revenue']      += $trans_item['total_price'];
        }
        $data['cost'] = Cost::where( 'created_at', '>=', $today.' 00:00:00' )->get()->toArray();
        foreach ($data['cost'] as $cost_today) {
            $data['today_cost']      += $cost_today['nominal'];
        }
        // dd( \Hash::make('admin123rty') );
        return view( 'admin.dashboard.index', $data );
    }

    public function setStatus($book_schedule_id){
        $id     = Crypt::decrypt($book_schedule_id);
        $set    = Input::get('set');

        $book_schedule = BookSchedule::find( $id );
        $book_schedule->status = $set;
        $book_schedule->save();

        return Redirect::back();
    }

    public function selectDate(){
        $input = Input::all();
        $input['date'] = str_replace('/', '-', $input['date']);

        return Redirect::route('system.index', $input['date']);
    }

    public function postBooking(){
        $input                              = Input::all();
        $data['book_schedule']['field_id']  = Crypt::decrypt($input['fid']);
        $data['book']['user_id']            = Auth::user()->id;
        $data['book']['start']              = $input['dari'];
        $start = explode(':', $data['book']['start']);
        $data['book']['end']                = $start[0] + $input['duration'].":".$start[1];
        $price = explode('.', $input['harga']);
        $data['book']['price']              = $price[1].$price[2];
        $book = Book::create( $data['book'] );
        $data['book_schedule']['date']      = $input['date'];
        $data['book_schedule']['duration']  = $input['duration'];
        $data['book_schedule']['book_id']   = $book->id;
        $owner_id = Station::find(Field::find($data['book_schedule']['field_id'])->station_id)->user_id;
        $admin_id = User::find(Auth::user()->id)->group_id;
        if ( Auth::user()->id == $owner_id || $admin_id == 1 ) {
            $data['book_schedule']['status'] = "approved";
        }
        $book_schedule = BookSchedule::create( $data['book_schedule'] );

        return Redirect::back();
    }


    /**
     * Private Function.
     *
     * @return \Illuminate\Http\Response
     */
    public function dayBuilder($today = false){
        if ( !$today ) {
            $data['date']   = date("d-m-y");
            $data['day']    = date("l");
            $data['tonaw']  = date("D");
        } else {
            $data['date']   = $today;
            $data['now']    = explode('-', $data['date']);
            $data['day']    = date("l" , strtotime( $data['now'][2]."-".$data['now'][0]."-".$data['now'][1] ));

            switch ($data['day']) {
                case 'Monday':
                    $data['tonaw'] = 'Mon';
                break;
                case 'Tuesday':
                    $data['tonaw'] = 'Tue';
                break;
                case 'Wednesday':
                    $data['tonaw'] = 'Wed';
                break;
                case 'Thursday':
                    $data['tonaw'] = 'Thu';
                break;
                case 'Friday':
                    $data['tonaw'] = 'Fri';
                break;
                case 'Saturday':
                    $data['tonaw'] = 'Sat';
                break;
                case 'Sunday':
                    $data['tonaw'] = 'Sun';
                break;
            }
        }
        $data['date'] = explode('-', $data['date']);
        $data['date'] = $data['date'][1]."-".$data['date'][0]."-".$data['date'][2];

        return $data;
    }

    public function StationOwnerData($data){
        $data['my_station'] = Station::where( 'user_id', $data['user']->id )
                            ->orWhere('user_id', 'like', '%' . $data['user']->id . '%')->first();
        $data['field']      = Field::where( 'station_id', $data['my_station']['id'] )->get()->toArray();
        
        for ($z=0; $z < count( $data['field'] ); $z++) { 
            $data['schedule'][$data['field'][$z]['name']] = [];
            foreach (json_decode($data['field'][$z]['schedule']) as $schedule) {
                //Push Semua Hari yang ada di schedule ke json schedule
                for ($i=0; $i < count( $schedule->hari ); $i++) { 
                    //Check Hari sudah pernah di push gak di json schedule
                    if (!in_array($schedule->hari[$i], $data['schedule'][$data['field'][$z]['name']])) {
                        $jam['mulai']      = (int)explode(":", $schedule->jam_mulai)[0];
                        $jam['selesai']    = ($schedule->jam_selesai == "00:00")?23:(int)explode(":", $schedule->jam_selesai)[0] - 1;
                        //check di book_schedule apa ada data dengan tanggal hari ini
                        
                        $minutes = "00";
                        for ($c=$jam['mulai']; $c <= $jam['selesai']; $c++) {
                            $status = 0;
                            $book_schedule = Book::whereBetween( 'start', [$c.':00', $c.':59'] )
                                        ->join('book_schedule', 'book_schedule.book_id', '=', 'book.id')
                                        ->join('field', 'book_schedule.field_id', '=', 'field.id')
                                        ->join('station', 'field.station_id', '=', 'station.id')
                                        ->where( 'date', $data['dayBuilderData']['date'] )
                                        ->where( 'book_schedule.status', 'approved' )
                                        ->select( 'book.id as book_id','book_schedule.id as book_schedule_id','station.name as station' ,'field.name as field', 'book.user_id', 'start', 'end', 'duration', 'date', 'book_schedule.status', 'price' )
                                        ->where( 'field_id', $data['field'][$z]['id'] )
                                        ->first();
                            // dd( $book_schedule->toArray() );
                            if (!empty( $book_schedule )) {
                                $status = 9999;
                                $minutes = explode(':', $book_schedule['start'])[1];
                                for ($l=0; $l < $book_schedule['duration']; $l++) { 
                                    $data['schedule'][$data['field'][$z]['name']][$schedule->hari[$i]][$c+$l.":".$minutes ] = [
                                        "status"    => $status,
                                        "price"     => $schedule->harga
                                    ];
                                }
                                $c += $book_schedule['duration'] - 1;
                            } else {
                                $data['schedule'][$data['field'][$z]['name']][$schedule->hari[$i]][$c.":". $minutes] = [
                                    "status"    => $status,
                                    "price"     => $schedule->harga
                                ];
                            }
                        }
                    }
                }
            }
            $data['count'][$z] = ( isset($data['schedule'][$data['field'][$z]['name']][$data['dayBuilderData']['tonaw']]) )?count($data['schedule'][$data['field'][$z]['name']][$data['dayBuilderData']['tonaw']]):0;
        }

        // dd($data);
        return $data;
    }
   
}