<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequestRequest;
use App\Models\RegisterRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function index() {
        $content = RegisterRequest::where('isVerified', null)->orderBy('id', 'asc')->get();
        return view('admin.auth.register-request', ['registerRequests' => $content]);
    }

    public function create() {
        return view('auth.register-request-create');
    }

    public function store(RegisterRequestRequest $request) {

        $request = $request->all();

        // dd($request);

        $reg = new RegisterRequest();
        $reg->name = $request['name'];
        $reg->message = $request['message'];
        $reg->tel = $request['tel'];
        $reg->department = $request['department'];
        $reg->email = $request['email'];

        $reg->save();

        return redirect()->route('home.index')
            ->with('success', 'Ваш запрос отправлен на рассмотрение!');
    }

    public function update(RegisterRequestRequest $request, $id) {
        dd($id);
        $request = $request->all();
        $rr = RegisterRequest::findOrFail($id);
        dd($rr);
        $request['isVerified'] = true;
        $request['verified_at'] = Carbon::now();
        $rr->update($request);
        return redirect()->route('admin')->with('success', 'Запрос одобрен!');
    }
}
