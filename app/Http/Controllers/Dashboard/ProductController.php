<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Product;
use Auth;

class ProductController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function index(Request $request){

        $products = DB::table('products')
                    ->select('products.name','spbu.name as spbu_name','products.id','price','is_available','longitude','spbu_id')
                    ->join('spbu', 'spbu.id','=','products.spbu_id')
                    ->where('operator_id', Auth::user()->id)
                    ->paginate(10);

        $data['products'] = $products;
        return view('product.index', $data);
    }
    
    public function add(){

        $spbu = DB::table('spbu')
                    ->select('name','id')
                    ->where('operator_id', Auth::user()->id)
                    ->get();
        
        $data['spbu'] = $spbu;
        return view('product.add', $data);
    }

    public function edit($id){

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

        $product = new Product;
        $product->name = $request->get('name');
        $product->price =  $request->get('price');
        $product->is_available =  $request->get('availability');
        $product->spbu_id =  $request->get('spbu_id');
        $product->save(); 

        return redirect('manage_products')->with('status', 'Product has been added');
    }

    public function update(Request $request){
        // update  product
        $product = Product::find($request->get('product_id'));
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->is_available = $request->get('availability');
        $product->spbu_id = $request->get('spbu_id');
        $product->save(); 

        return redirect('manage_products')->with('status', 'Product has been updated');
    }


	
}
