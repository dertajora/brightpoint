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

    public function list_spbu(Request $request){

    	$data = json_decode($request->get('data'));
        
        return response()->json(['result_code' => 1, 'result_message' => 'List SPBU request success.', 'data' => '']);
         
    }

    

    public function detail_spbu(Request $request){

        $data = json_decode($request->get('data'));

        return response()->json(['result_code' => 1, 'result_message' => 'Detail SPBU sent', 'data' => $package]);
    }


    
	
}
