<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Product;
use App\QueueCarwash;
use Auth;

class QueueController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function index(Request $request){

        $data['queue'] = DB::table('queue_carwash')
                    ->select('queue_carwash.id','queue_date','queue_no','source','user_id','remarks','spbu.name as spbu_name', 'status','customer','users.name as customer_registered')
                    ->join('spbu', 'spbu.id','=','queue_carwash.spbu_id')
                    ->leftJoin('users','users.id','=','queue_carwash.user_id')
                    ->where('operator_id', Auth::user()->id)
                    ->where('queue_carwash.created_at','>=',date('Y-m-d'))
                    ->paginate(10);

        $data['spbu'] = DB::table('spbu')
                    ->select('name','id')
                    ->where('operator_id', Auth::user()->id)
                    ->get();

        return view('carwash.index', $data);
    }
    
    public function add(){


        $spbu = DB::table('spbu')
                    ->select('name','id')
                    ->where('operator_id', Auth::user()->id)
                    ->get();
        
        $data['spbu'] = $spbu;
        return view('carwash.add_queue', $data);
    }

    public function finish($id){
        // update  product
        $queue = QueueCarwash::find($id);
        $queue->status = 3;
        $queue->updated_by = Auth::user()->id;
        $queue->save(); 

        return redirect('manage_queue')->with('status', 'Queue successfully updated ');
    }

    public function delete($id){

        $data['spbu'] = DB::table('spbu')
                    ->select('name','id')
                    ->where('operator_id', Auth::user()->id)
                    ->get();
        
        $data['detail_product'] = DB::table('products')
                    ->select('id','name','spbu_id','price','is_available','spbu_id')
                    ->where('id', $id)
                    ->first();

        return view('product.edit', $data);
    }

    public function save(Request $request){

        $last_queue = DB::table('queue_carwash')
                    ->where('queue_date', date('Y-m-d'))
                    ->where('spbu_id',$request->get('spbu_id'))
                    ->orderBy('created_at','desc')
                    ->pluck('queue_no');

        if (count($last_queue) == 0) {
            $queue_no = 1;
        }else{
            $queue_no = $last_queue[0] + 1;
        }

        $product = new QueueCarwash;
        $product->spbu_id = $request->get('spbu_id');
        $product->queue_date =  date('Y-m-d');
        $product->customer =  $request->get('customer');
        $product->spbu_id =  $request->get('spbu_id');
        $product->queue_no =  $queue_no;
        $product->source =  1; //1 means comes from manual queue
        $product->status =  1;
        $product->created_by =  Auth::user()->id;
        $product->save(); 

        return redirect('manage_queue')->with('status', 'Queue has been added manually');
    }

	
}
