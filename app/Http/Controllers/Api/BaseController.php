<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        // 컨트롤러의 기본 드라이버를 api 로 설정
        auth()->setDefaultDriver('api');
    }
}
