<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthWebController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $username = $request->username;
        $password = $request->password;
        
        $cek = User::where('username',$username);
        $role = $cek->first()->role;
        if($cek->count() > 0 && $role != 'pegawai'){
            $akun = $cek->first();
            if(Hash::check($password, $akun->password)){
                Session::put('userid',$akun->id);
                Session::put('role',$akun->role);
                Session::put('username',$akun->username);
                return redirect('/');
            }else{
                return redirect('login')->with("error","Periksa username & password anda");
            }
        }else{
            return redirect('login')->with("error","Periksa username & password anda");
        }

    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }

}
