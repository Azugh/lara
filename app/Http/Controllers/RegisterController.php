<?php

namespace App\Http\Controllers;

use App\Models\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function index() {
        return view('admin.auth.register-request');
    }

    public function create() {
        return view('auth.register-request-create');
    }

    public function store(Request $request) {

        // dd($request);
        $reg = new RegisterRequest();
        $request = $request->all();
        $reg->name = $request['name'];
        $reg->email = $request['email'];
        $reg->tel = $request['tel'];
        $reg->message = $request['message'];
        dd($reg);
    }
}
