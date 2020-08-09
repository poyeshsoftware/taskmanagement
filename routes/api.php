<?php

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

Route::middleware('auth:sanctum')->namespace('API\\')->group(function () {
    Route::get('/projects', 'ProjectController@index');
    Route::post('/projects', 'ProjectController@store');
    Route::post('/projects/resort', 'ProjectController@resort');
    Route::patch('/projects/{project:id}', 'ProjectController@update')->middleware('can:ownProject,project');
    Route::delete('/projects/{project:id}', 'ProjectController@destroy')->middleware('can:ownProject,project');


    Route::get('/projects/{project:id}/tasks', 'TaskController@index')->middleware('can:ownProject,project');
    Route::post('/projects/{project:id}/tasks', 'TaskController@store')->middleware('can:ownProject,project');
    Route::post('/projects/{project:id}/tasks/resort', 'TaskController@resort')->middleware('can:ownProject,project');
    Route::patch('/projects/{project:id}/tasks/{task:id}', 'TaskController@update')->middleware('can:ownProject,project')->middleware('can:ownTask,task');
    Route::delete('/projects/{project:id}/tasks/{task:id}', 'TaskController@destroy')->middleware('can:ownProject,project')->middleware('can:ownTask,task');

});
