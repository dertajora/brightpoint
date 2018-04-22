<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\SPBU;
use App\QueueCarwash;

class BrightwashController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    function count_total_queue($spbu_id){
        $queue = DB::table('queue_carwash')
                     ->select(DB::raw('count(id) as total_queue, spbu_id'))
                     ->where('queue_date', date('Y-m-d'))
                     ->where('status',1)
                     ->where('spbu_id',$spbu_id)
                     ->groupBy('spbu_id')
                     ->first();

        if (empty($queue)) {
            return 0;
        }
        return $queue->total_queue;
    }

    function select_current_queue($spbu_id){
        $current_queue = DB::table('queue_carwash')
                     ->select('queue_no')
                     ->where('queue_date', date('Y-m-d'))
                     ->where('status',1)
                     ->where('spbu_id',$spbu_id)
                     ->orderBy('id','asc')
                     ->first();

        if (empty($current_queue)) {
            return 0;
        }
        return $current_queue->queue_no;

    }

    public function find_brightwash(Request $request){

    	$data = json_decode($request->get('data'));

        if ( empty($data->start_lat) OR empty($data->start_longi) )
            return response()->json(['result_code' => 2, 'result_message' => 'Current Latitude and Longitude is mandatory', 'data' => '']);
        
        $nearest_brightwash = DB::table('spbu')
                            ->select('id','name','address','latitude','longitude','capacity',
                                     DB::raw('( 6371 * ACOS( COS( RADIANS( '.$data->start_lat.' ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) 
                                        - RADIANS( '.$data->start_longi.' ) ) + SIN(RADIANS('.$data->start_lat.') ) * SIN( RADIANS( latitude ) ) ) ) as distance'))
                            ->where('is_brightwash',1)
                            ->orderBy('distance','asc')
                            ->limit(5)->get();

        foreach ($nearest_brightwash as $row) {
            $row->distance = round($row->distance,2);
            $row->current_queue = $this->count_total_queue($row->id);
        }

        return response()->json(['result_code' => 1, 'result_message' => 'List Brightwash request success.', 'data' => $nearest_brightwash]);
         
    }

    public function detail_brightwash(Request $request){

        $data = json_decode($request->get('data'));
        if (empty($data->spbu_id)) 
            return response()->json(['result_code' => 2, 'result_message' => 'SPBU ID is mandatory', 'data' => '']);
        
        $detail = DB::table('spbu')
                            ->select('id','capacity','name','latitude','longitude','address')
                            ->where('id',$data->spbu_id)->first();

        $detail->current_queue = rand(0,2);
        $detail->image = url('/')."/public/images/brightwash/image-1.jpg";


        return response()->json(['result_code' => 1, 'result_message' => 'Detail BrightWash sent', 'data' => $detail]);
    }

    public function book_wash(Request $request){

        $data = json_decode($request->get('data'));
        $user_info = json_decode($request->get('user_info'));
        if (empty($data->spbu_id)) 
            return response()->json(['result_code' => 2, 'result_message' => 'SPBU ID is mandatory', 'data' => '']);
        
        $last_queue = DB::table('queue_carwash')
                    ->where('queue_date', date('Y-m-d'))
                    ->where('spbu_id',$data->spbu_id)
                    ->orderBy('created_at','desc')
                    ->pluck('queue_no');

        if (count($last_queue) == 0) {
            $queue_no = 1;
        }else{
            $queue_no = $last_queue[0] + 1;
        }

        $user_id = User::where('phone', $user_info->phone)->pluck('id');
        $spbu = SPBU::where('id', $data->spbu_id)->pluck('name');

        $queue = new QueueCarwash;
        $queue->spbu_id = $data->spbu_id;
        $queue->queue_date =  date('Y-m-d');
        $queue->spbu_id =  $data->spbu_id;
        $queue->queue_no =  $queue_no;
        $queue->user_id =  $user_id[0];
        $queue->source =  2; //1 means comes from manual queue
        $queue->status =  1;
        $queue->created_by =  0;
        $queue->save(); 

        $response['queue_no'] = $queue_no;
        $response['spbu_name'] = $spbu[0];
        return response()->json(['result_code' => 1, 'result_message' => 'Booking a wash is success', 'data' => $response]);
    }

    public function wash_schedule(Request $request){

        $user_info = json_decode($request->get('user_info'));
        
        $user_id = User::where('phone', $user_info->phone)->pluck('id');

        $my_schedule = DB::table('queue_carwash')
                    ->select('queue_no','queue_date','status','spbu_id','spbu.name as spbu_name','queue_date')
                    ->where('user_id',$user_id)
                    ->join('spbu', 'spbu.id','=','queue_carwash.spbu_id')
                    ->orderBy('queue_carwash.created_at','desc')
                    ->get();

        foreach ($my_schedule as $row) {
            if ($row->status == 1) {
                $row->current_queue = $this->select_current_queue($row->spbu_id);
                $row->estimation_time = ($row->$queue_no - $row->current_queue ) * 30;
            }else{
                $row->current_queue = 0;
                $row->estimation_time = 0;
            }

            if ($row->status == 1) {
                $row->status = "In-Progress";
            }elseif ($row->status == 2) {
                $row->status = "Cancelled";
            }elseif($row->status == 3) {
                $row->status = "Done";
            }

        }
        
        return response()->json(['result_code' => 1, 'result_message' => 'List schedule sent', 'data' => $my_schedule]);
    }

}
