<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| Get requests are routed to the 'input' function of the echoTestController 
| located in App\Http\Controlers
|
| Post requests (generated after submitting the form) are routed to the
| 'output' function of the same controller file
|
| These routes are given shortform names that the program can then refer
| back to. (IE. return route('echo.input') will result in the input
| function of the echoTestController file being executed)
*/
Route::get('echo', 'echoTestController@input')->name('echo.input');
Route::post('echo', 'echoTestController@output')->name('echo.output');

Route::get('/', 'forumController@home')->name('forum.home');


/* Route for testing */
Route::get('test', function(){
    return view('test');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
