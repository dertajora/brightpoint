<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Companies;
use App\Roles;
use Illuminate\Support\Facades\Crypt;
use Auth;


class WebsiteController extends Controller
{
	public function __construct(){
	    ini_set('max_input_time', 6000);
        ini_set('max_execution_time', 100000);
        ini_set('memory_limit', '1024M');
	}

    public function login_page(){
        return view('website.login');
    }

    public function login_handle(Request $request){
        $user_found = User::where('phone', $request->get('phone'))->where('role_id','!=',1)->count();
        if ($user_found == 0) 
            return redirect('login')->with('status', 'Login failed. User not found!'); 

        $user = User::where('phone', $request->get('phone'))->first();
        $user_current_password = Crypt::decrypt($user->password);

        if ($user_current_password != $request->get('password')) 
            return redirect('login')->with('status', 'Login failed. Invalid password!'); 

        // auth user
        Auth::login($user);
        $role = Roles::where('id', $user->role_id)->first();
        session(['role_name' => $role->name]);
        // redirect to intended menu/url
        return redirect()->intended('/dashboard');

    }

    public function laboratorium(){
 
        $locations[] = array(
            'name' => 'Moxy',
            'lat' => -6.900079, 
            'lng' => 107.612222
        );

        $locations[] = array(
            'name' => 'KPAD Gegerkalong',
            'lat' => -6.867916,  
            'lng' => 107.586257
        );

        $locations[] = array(
            'name' => 'Telkom Gegerkalong',
            'lat' => -6.871925, 
            'lng' => 107.588573
        );

        $locations[] = array(
            'name' => 'Cups Coffe',
            'lat' => -6.901317, 
            'lng' => 107.613553
        );

        $locations[] = array(
            'name' => 'ITB',
            'lat' => -6.891587, 
            'lng' => 107.610691
        );

        $new_list[0] = $locations[0];
        
        array_splice($locations,0,1);
        $locations_absolute = $locations;
        $next = 1;
        for ($i=0; $i < count($locations_absolute); $i++) { 
            
            print_r($new_list);
            
            $nearest = $this->get_nearest_position($new_list[$i], $locations);
            
            $new_list[$next] = $locations[$nearest];
            array_splice($locations,$nearest,1);
            $next = $next + 1;
            
        }
       
    }

    public function get_nearest_position($start_position, $list_locations){
        for ($i=0; $i < count($list_locations) ; $i++) { 
            $list_locations[$i]['distance'] = $this->haversine_method($start_position['lat'], $start_position['lng'], $list_locations[$i]['lat'], $list_locations[$i]['lng']);
        }

        $index_nearest = $this->minOfKey($list_locations, "distance");
        return $index_nearest;
        
    }

    function minOfKey($array, $key) {
        if (!is_array($array) || count($array) == 0) return false;
        $min = $array[0][$key];
        $x = 0;
        $key_array = 0;
        foreach($array as $a) {
            if($a[$key] < $min) {
                   $min = $a[$key];
                   $key_array = $x;
            }
            $x = $x+1;
        }
        return $key_array;
    }

    function haversine_method($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
          $earthRadius = 6371000;
          // convert from degrees to radians
          $latFrom = deg2rad($latitudeFrom);
          $lonFrom = deg2rad($longitudeFrom);
          $latTo = deg2rad($latitudeTo);
          $lonTo = deg2rad($longitudeTo);

          $latDelta = $latTo - $latFrom;
          $lonDelta = $lonTo - $lonFrom;

          $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
          return $angle * $earthRadius;
    }

	
}
