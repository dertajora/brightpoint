<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
// use App\SPBU;

class BrightwashController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function find_brightwash(Request $request){

    	$data = json_decode($request->get('data'));

        if ( empty($data->start_lat) OR empty($data->start_longi) )
            return response()->json(['result_code' => 2, 'result_message' => 'Current Latitude and Longitude is mandatory', 'data' => '']);
        
        $nearest_brightwash = DB::table('spbu')
                            ->select('id','name','address','latitude','longitude',
                                     DB::raw('( 6371 * ACOS( COS( RADIANS( '.$data->start_lat.' ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) 
                                        - RADIANS( '.$data->start_longi.' ) ) + SIN(RADIANS('.$data->start_lat.') ) * SIN( RADIANS( latitude ) ) ) ) as distance'))
                            ->where('is_brightwash',1)
                            ->orderBy('distance','asc')
                            ->limit(5)->get();

        foreach ($nearest_brightwash as $row) {
            $row->distance = round($row->distance,2);
            $row->capacity = rand(1,2);
            $row->current_queue = rand(0,2);
        }

        return response()->json(['result_code' => 1, 'result_message' => 'List Brightwash request success.', 'data' => $nearest_brightwash]);
         
    }

    public function detail_brightwash(Request $request){

        $data = json_decode($request->get('data'));
        if (empty($data->spbu_id)) 
            return response()->json(['result_code' => 2, 'result_message' => 'SPBU ID is mandatory', 'data' => '']);
        
        $detail = DB::table('spbu')
                            ->select('id','name','latitude','longitude','address')
                            ->where('id',$data->spbu_id)->first();

        $detail->current_queue = rand(0,2);
        $detail->image = url('/')."/public/images/brightwash/image-1.jpg";


        return response()->json(['result_code' => 1, 'result_message' => 'Detail BrightWash sent', 'data' => $detail]);
    }

    public function book_wash(Request $request){

        $data = json_decode($request->get('data'));
        if (empty($data->spbu_id)) 
            return response()->json(['result_code' => 2, 'result_message' => 'SPBU ID is mandatory', 'data' => '']);
        
        return response()->json(['result_code' => 1, 'result_message' => 'Booking a wash is success', 'data' => '']);
    }

}
