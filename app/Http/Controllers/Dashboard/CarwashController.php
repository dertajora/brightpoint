<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Product;
use App\SPBU;
use Auth;

class CarwashController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function config(Request $request){

        $data['spbu'] = DB::table('spbu')
                    ->select('id','name','capacity','closed_at','open_at')
                    ->where('operator_id', Auth::user()->id)
                    ->where('is_brightwash',1)
                    ->paginate(10);

        return view('carwash.index_config', $data);
    }

    public function edit($id){

        $data['detail_spbu'] = DB::table('spbu')
                    ->select('id','name','capacity','closed_at','open_at')
                    ->where('operator_id', Auth::user()->id)
                    ->where('is_brightwash',1)
                    ->where('id', $id)
                    ->first();
    
        return view('carwash.edit_config', $data);
    }

    public function update(Request $request){
        // update  config
        $product = SPBU::find($request->get('spbu_id'));
        $product->capacity = $request->get('capacity');
        $product->open_at = $request->get('open_at');
        $product->closed_at = $request->get('closed_at');
        $product->save(); 

        return redirect('config_carwash')->with('status', 'Config carwash has been updated');
    }


	
}
