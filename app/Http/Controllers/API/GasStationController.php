<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
// use App\SPBU;

class GasStationController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function nearest_spbu(Request $request){

    	$data = json_decode($request->get('data'));

        if ( empty($data->current_lat) OR empty($data->current_longi) )
            return response()->json(['result_code' => 2, 'result_message' => 'Current Latitude and Longitude is mandatory', 'data' => '']);
        
        $nearest_spbu = DB::table('spbu')
                            ->select('name','address','latitude','longitude',
                                     'is_mosque','is_toilet', 'is_brightwash',
                                     'is_snack_store','is_olimart',
                                     DB::raw('( 6371 * ACOS( COS( RADIANS( '.$data->current_lat.' ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) 
                                        - RADIANS( '.$data->current_longi.' ) ) + SIN(RADIANS('.$data->current_lat.') ) * SIN( RADIANS( latitude ) ) ) ) as distance'))
                            ->orderBy('distance','asc')
                            ->limit(5)->get();

        foreach ($nearest_spbu as $row) {
            $row->distance = round($row->distance,2);
        }

        return response()->json(['result_code' => 1, 'result_message' => 'List SPBU request success.', 'data' => $nearest_spbu]);
         
    }

    

    public function detail_spbu(Request $request){

        $data = json_decode($request->get('data'));
        if (empty($data->spbu_id)) 
            return response()->json(['result_code' => 2, 'result_message' => 'SPBU ID is mandatory', 'data' => '']);
        
        $response['detail'] = DB::table('spbu')
                            ->select('name','latitude','longitude',
                                     'is_mosque','is_toilet', 'is_brightwash',
                                     'is_snack_store','is_olimart')
                            ->where('id',$data->spbu_id)->first();

        $response['products'] = DB::table('products')
                            ->select('name','price','is_available')
                            ->where('spbu_id', $data->spbu_id)
                            ->orderBy('name','asc')
                            ->get();

        return response()->json(['result_code' => 1, 'result_message' => 'Detail SPBU sent', 'data' => $response ]);
    }


    
	
}
