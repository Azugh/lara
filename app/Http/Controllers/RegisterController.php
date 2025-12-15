<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequestRequest;
use App\Models\RegisterRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //

    public function index() {
        $content = RegisterRequest::where('isVerified', false)->orderBy('id', 'asc')->get();
        return view('admin.auth.register_request', ['registerRequests' => $content]);
    }

    public function create() {
        return view('auth.register_request-create');
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

    // Верификация пользователя
    // isVerified - пользователь подтвержден админом
    // verified_at кастомное время валидации полльзователя
    public function update($id) {


        $rr = RegisterRequest::findOrFail($id);

        $rr->isVerified = true;
        $rr->verified_at = now();

        $rr->update();


        return redirect()->route('register_request.index')->with('success', 'Запрос одобрен!');
    }

        public function destroy($id)
    {
        $registerRequest = RegisterRequest::findOrFail($id);
        $registerRequest->delete();

        return redirect()->route('register_request.index')
            ->with('success', 'Запрос успешно удален!');
    }
}
