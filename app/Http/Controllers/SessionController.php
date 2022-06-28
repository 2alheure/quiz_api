<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller {
    public function requestSession() {
        $token = new Token;
        $token->save();
        return new JsonResponse($token);
    }
}
