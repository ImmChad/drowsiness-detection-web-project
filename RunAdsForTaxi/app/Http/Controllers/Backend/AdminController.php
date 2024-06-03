<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use stdClass;

class AdminController extends Controller

{
    function index() {
        return Redirect::to('/dashboard');
    }

    function renderLoginView()
    {
        return view('Backend.login');
    }

    function loginAdmin(Request $request) {

        $numPhone = $request->numPhone;
        $password = $request->password;

        // dd($password);

        $infoAdmin = DB::table('admin')
        ->where(['num_phone_admin'=>$numPhone])
        ->where(['password_admin'=>$password])->get()->first();

        if(isset($infoAdmin)) {
            $request->session()->put('infoAdmin',$infoAdmin);
            return Redirect::to('/dashboard');
        } else {
            return view('Backend.login')
            ->with('messToast', 'Your number phone or password wrong.');
        }
    }

    function logoutAdmin() {
        Session::forget('infoAdmin');
        return Redirect::to("/");
    }

    function renderAboutUs()
    {
        return view('Backend.main.about-us')->with(['pagination' => 4]);
    }
}
