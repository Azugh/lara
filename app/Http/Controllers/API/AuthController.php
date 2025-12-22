<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    //
    use Authenticatable;

    public function register(Request $request)
    {

        dd($request->all());

        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|string|email|max:50|',
            'tel' => 'required|string|max:11',
            'department' => 'required|string|max:20',
        ]);


        $user = User::create(['name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'department' => $request->department,
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $token, 'token_type' => 'Bearer',], 201);
        // return redirect()->route('register_request.index')->with('success', 'Регистрация пользователя одобрен!');
    }

    public function login(Request $request)
    {

        $request->validate(['email' => 'required|email']);
        try {
            $user = User::where('email', $request->email)->first();

            $tokens = $user->tokens()
                ->with('client')
                ->where('revoked', false)
                ->where('expires_at', '>', Date::now())
                ->get()
                ->filter(fn(Token $token) => $token->client->hasGrantType('personal_access'));
            if ($tokens->isNotEmpty()) {
                $token = $tokens->first();

                return response()->json(['message' => $user], 200);
            }
            $token = $user->createToken('auth_token')->accessToken;

            return response()->json(['message' => $user, 'tokens' => $tokens], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
//        if (Auth::attempt(['email' => $request->email, 'password' => '12345'])) {
//            $user = Auth::user();
//            $token = $user->createToken('auth_token')->accessToken;
//            return response()->json(['success' => $token, 'user' => $user], 200);
////            $accessToken = $user->createToken('authToken')->accessToken;
//        }

        // Запрос access_token
        // http://nginx/oauth/token
//        try {
//            $response = Http::asForm()->post('http://nginx/oauth/token',
//                ['grant_type' => 'password',
//                    'client_id' => $user->id,
////                    'client_id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
//                    'client_secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
//                    'username' => $user->email,
//                    'password' => '12345',
//                    'scope' => '',
//                    ]);
//
//            $data = $response->json();
//            session()->put('access_token', $data['access_token']);
//        } catch (Exception $e) {
//            return response()->json(['message' => $e->getMessage()], 500);
//        }
//
//        dd($data);

//        return redirect()->route('home.index');

//        $user = User::where('email', $request->email)->first();
//
//        $token =  $user->createToken('auth_token')->plainTextToken;
//
//        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function getUser()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json(['user' => $user], 200);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        Auth::user()->token()->revoke();
        return response()->json(['message' => 'Успешно выход']);
    }
}
