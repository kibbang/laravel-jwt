<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

use App\Http\Controllers\Api\BaseController;

class JWTAuthController extends BaseController
{
    //

    public function __construct()
    {
        parent::__construct();
    }

    public function login(Request $request)
    {
        // 사용자가 입력한 정보
        $credentials = request(['email', 'password']);

        // 입력된 정보로 토큰값을 가져온다.
        $token = auth()->attempt($credentials);

        // dd($token);

        if(!$token) {
            return response()->json(['error' => 'Unauthorized'], RESPONSE::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'acess_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'current_user' => auth()->user()
        ]);
    }

    public function register(RegisterRequest $request){

        // 새로운 사용자 만들기
        $newUser = User::create($request->all());

        // 방금 생성한 사용자로 로그인 한다.
        return $this->login($request);
    }

}
