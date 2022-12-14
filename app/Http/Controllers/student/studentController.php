<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;


class studentController extends Controller
{
    public function index()
    {
        return view('student.Home');
    }
    public function lodaLogin()
    {
        return view('student.Login');
    }
    public function registration()
    {
        return view('student.Registration');
    }
    public function createStudent(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'name'=>'required|min:4|max:30|string',
            'email'=>'required|email|max:50',
            'password'=>'required|min:6|max:10|confirmed'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        if($validate){
            $createStudent = User::create([
                'name'=>$req->name,
                'email'=>$req->email,
                'password'=>Hash::make($req->password)
            ]);
            if($createStudent){
                $createStudent->save();
                     return redirect('/login')->with([
                'msg'=>'Your account created successfully',
            ]);
            }
            else{
                return redirect('/registration')->with([
                    'msg'=>$createStudent->errors(),
                ]);
            }
        }
    }

    public function studentLogin(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'email'=>'required|email',
            'password'=>'required|min:6|max:10|confirmed'
        ]);
        $studentCredential = $req->only('email','password');

        if(Auth::attempt($studentCredential)){
            if(Auth::user()->is_admin == 1){
                return view('admin.dashboard');
            }
            else{
                return view('student.Home');
            }
        }

    }
    public function logout(Request $req)
    {
        $req->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
