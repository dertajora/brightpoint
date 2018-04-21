<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\SPBU;
use Auth;

class SPBUController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function index(Request $request){

        $spbu = DB::table('spbu')
                    ->select('id','name','address','latitude','longitude',
                             'is_mosque','is_toilet', 'is_brightwash',
                             'is_snack_store','is_olimart')
                    ->where('operator_id', Auth::user()->id)
                    ->paginate(10);

        $data['spbu'] = $spbu;
        return view('spbu.index', $data);
    }
    
    public function add(){
        return view('spbu.add');
    }

    public function save(Request $request){

        $spbu = new SPBU;
        $spbu->name = $request->get('name');
        $spbu->latitude = $request->get('latitude');
        $spbu->longitude = $request->get('longitude');
        $spbu->address = $request->get('address');
        $spbu->is_toilet = $request->get('is_toilet');
        $spbu->is_mosque = $request->get('is_mosque');
        $spbu->is_snack_store = $request->get('is_snack_store');
        $spbu->is_olimart =  $request->get('is_olimart');
        $spbu->is_brightwash =  $request->get('is_brightwash');
        $spbu->operator_id =  Auth::user()->id;

        $spbu->save(); 

        return redirect('manage_spbu')->with('status', 'SPBU has been added'); ;
    }


	
}
