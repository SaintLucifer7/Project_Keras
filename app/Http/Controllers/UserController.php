<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
use Cookie;
use Redirect;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $name = Auth::getRecallerName();
        if (Cookie::has($name)) {
            return view('home');
        }else if(!Session::get('login')){
            return redirect('login')->with('alert','You need to login first');
        }
        else{
            return view('home');
        }
    }

    public function login(){
        $name = Auth::getRecallerName();
        if (Cookie::has($name)) {
            return view('home');
        }if(Session::get('login')){
            return redirect('home');
        }
        return view('login');
    }

    public function loginPost(Request $request){
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;
        
        $data = User::where('username',$username)->first();
        if($data){
            if($password == $data->password){
                Session::put('id', $data->id);
                Session::put('name',$data->name);
                Session::put('username',$data->username);
                Session::put('password',$data->password);
                Session::put('login',TRUE);
                Session::put('role', $data->role);
                if(!empty($remember)){
                    Auth::login($data, true);
                }
                return redirect('home');
            }else{
                return redirect('login')->with('alert','Username or Password is wrong !');
            }
        }else{
            return redirect('login')->with('alert','Username or Password is wrong!');
        }
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('login')->with('alert','You\'re already logged out');
    }

    public function register(Request $request){
        return view('register');
    }

    public function registerPost(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new User();
        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->role = 'Karyawan';
        $data->save();
        return redirect('login')->with('alert-success','Register Success!');
    }

    public function account()
    {
        $user = User::all()->toArray();
        return view('account',compact('user'));
    }
    public function destroy($id)
    {
        $user = DB::table('users')->where ('id',$id)->limit(1);
        $user->delete();
        return redirect()->route('account')->with('success', 'User Deleted');
    }
    public function myprofile()
    {
        $user = DB::table('users')->where ('username',Session::get('username'))->first();
        return view('myprofile',compact('user'));
    }
    public function updateprofile()
    {
        $user = DB::table('users')->where ('username',Session::get('username'))->limit(1);
        return view('updateprofile',compact('user'));
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'username' => 'required'
        ]);
        $user = DB::table('users')->where ('username',Session::get('username'))
                                    ->update([
                                                'name'=> $request->get('name'),
                                                'username'=>$request->get('username')
                                            ]);
        Session::put('name', $request->get('name'));
        Session::put('username',$request->get('username'));                        
        $user = DB::table('users') -> where ('username',$request->get('username'))->first();
        return view('myprofile',compact('user'));
    }   
    public function changepass(Request $request)
    {
        return view ('changepassword');
    } 
    public function updatepass(Request $request)
    {
        $this->validate($request,[
            'new' => 'required',
            'connew' => 'required|same:new'
        ]);
        $user = DB::table('users')->where ('username',Session::get('username'))
                                  ->update([
                                        'password'=> $request->get('new'),
                                    ]);
        Session::put('password', $request->get('new'));
        $user = DB::table('users') -> where ('username',Session::get('username'))->first();
        return view('myprofile',compact('user'));

    }
}

