<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Auth;

class UserController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function index(Request $request){
        $users = DB::table('users')
                    ->select('roles.name as role', 'users.id', 'users.name' , 'users.email', 'users.phone')
                    ->join('roles','roles.id','=','users.role_id')
                    ->paginate(10);
    
        $data['users'] = $users;
        return view('users.index', $data);
    }
    
    public function add(){
        return view('users.add');
    }

    public function save(Request $request){

        $user = new User;
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->password = Crypt::encrypt($request->get('password'));
        $user->role_id = $request->get('role');
        $user->save(); 

        return redirect('users')->with('status', 'Employee has been added'); ;
    }


	
}
