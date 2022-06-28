<?php

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', 'App\Http\Controllers\QuestionController@get');
Route::get('/categories', 'App\Http\Controllers\CategoryController@get');
Route::get('/session', 'App\Http\Controllers\SessionController@requestSession');

Route::get('/test', function () {
    $q = Question::with(['category', 'language', 'responses', 'type', 'sessions'])->find(3);
    dd($q);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
