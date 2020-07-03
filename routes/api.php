<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projects', 'ProjectController@index');
    Route::post('/projects', 'ProjectController@store');
    Route::patch('/projects/{project:id}', 'ProjectController@update');
    Route::delete('/projects/{project:id}', 'ProjectController@destroy');
    Route::post('/projects/resort', 'ProjectController@resort');

    Route::get('/projects/{project:id}/tasks', 'TaskController@index');
    Route::post('/projects/{project:id}/tasks', 'TaskController@store');
    Route::patch('/projects/{project:id}/tasks/{task:id}', 'TaskController@update');
    Route::delete('/projects/{project:id}/tasks/{task:id}', 'TaskController@destroy');
    Route::post('/projects/{project:id}/tasks/resort', 'TaskController@resort');
});

//Route::middleware('auth:sanctum')->get('/projects', function (Request $request) {
//    return $request->user();
//});
