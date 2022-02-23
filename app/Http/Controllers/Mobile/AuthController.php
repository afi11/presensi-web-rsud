<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Pegawai;
use Carbon\Carbon;
use Validator;

class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'resetPassword']]);
    }

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'username' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out', 'success' => true]);
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function getProfil(Request $request)
    {
        $pegawaiCode = $request->pegawaiCode;
        $pegawai = Pegawai::join('divisi', 'divisi.id', '=', 'pegawai.idDivisi')
            ->join('users', 'users.pegawai_code', '=', 'pegawai.code')
            ->where('code', $pegawaiCode)
            ->select('pegawai.*', 'divisi.namaDivisi', 'users.email')
            ->first();
        return response()->json(["code" => 200, "data" => $pegawai]);
    }

    public function resetPassword(Request $request)
    {
        $pegawai = Pegawai::join('users', 'users.pegawai_code', '=', 'pegawai.code')
            ->where('code', $request->pegawaiCode)->first();
        $details = [
            'pegawaiCode' => $pegawai->code,
            'namaPegawai' => $pegawai->nama
        ];
        Mail::to($pegawai->email)->send(new \App\Mail\ResetPassword($details));
        return response()->json(["code" => 200, "message" => "Berhasil melakukan reset password", "email" => $pegawai->email]);
    }

    public function updateProfil(Request $request, $pegawaiCode)
    {
        if($request->fotoUser != ""){
            $tipeFile = $request->tipefile;
            if($tipeFile == "image/jpeg"){
                $tipe = ".jpg";
            }else{
                $tipe = ".png";
            }
            $fileName = Carbon::now()->format('Y-m-d').'-'.\Illuminate\Support\Str::random(10).$tipe;
            $path = public_path().'/assets/img/users/';
            file_put_contents($path.$fileName,base64_decode($request->fotoUser));
            $pegawai = Pegawai::where('code', $pegawaiCode)->update([
                'nama' => $request->nama,
                'nik' => $request->nik,   
                'foto_pegawai' => $fileName
            ]);
        }else{
            $pegawai = Pegawai::where('code', $pegawaiCode)->update([
                'nama' => $request->nama,
                'nik' => $request->nik,   
            ]);
        }
      
        $getUser = User::where('pegawai_code', $pegawaiCode)->first();
        $user = User::find($getUser->id);
        $user->email = $request->email;
        if($request->password != ""){
            $user->password = bcrypt($request->password);
            $user->password_hint = $request->password;
        }
        $user->save();
        return response()->json(["code" => 200, "message" => "Berhasil melakukan update profil"]);
    }
}
