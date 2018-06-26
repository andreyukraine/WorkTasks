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
Route::get('/', function () { return view('index');});

Auth::routes();

Route::get('/logout', function(){
    \Auth::logout();
    return redirect(route('login'));
})->name('logout');

Route::get('delete_task/{id}',['uses'=>'TaskController@destroy', 'as'=>'delete.task']);
Route::get('delete_category/{id}',['uses'=>'CategoryController@destroy', 'as'=>'delete.category']);

//для всех авторизированіх
Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', 'TaskController');
    Route::post('/ajax','TaskController@index');
    Route::resource('category', 'CategoryController');

});

//для пользователей
Route::group(['middleware' => 'users'], function () {
    Route::get('/users', ['uses'=>'Users\UsersController@show', 'as'=>'user_panel']);
});

//для алминов
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', ['uses'=>'Admin\AdminController@show', 'as'=>'admin_panel']);
    Route::get('/admin_users', ['uses'=>'Users\UsersController@index', 'as'=>'admin.users']);


});