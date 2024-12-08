<?php

use Illuminate\Support\Facades\Route;

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

// Visitors aka General Users
// Route::get('/', 'AppUserController@index')->name('signup');
// Route::get('/login', 'AppUserController@login');
Route::get('/reload_image', function(){
    return view('visitors.img_reload');
});
// Route::post('/login', 'AppUserController@login_process');
Route::post('/login_regular','AppUserController@login_process_regular');
Route::get('/logout', 'AppUserController@logout');
// Login Status check
Route::get('/check', 'AppUserController@is_logged_in');

// Route::post('/signup', 'AppUserController@signup');
Route::get('/verify/{email}/{code}', 'AppUserController@verify_user');

Route::get('/forgot-password', 'AppUserController@forgot_pass');
Route::post('/forgot-password', 'AppUserController@forgot_pass_process');

Route::get('/forgot/{email}/{code}', 'AppUserController@reset_pass');


// Version 02

Route::post('/reset-password', 'AppUserController@reset_pass_process');

Route::get('/signup_gen/{rows}/{cols}','AppUserController@expert_gen_req'); // 
Route::get('/','AppUserController@expert_index'); // 
Route::post('/signup-new','AppUserController@expert_index_process'); // 
Route::get('/test-session','AppUserController@test_session'); // 
Route::get('/login','AppUserController@expert_login'); // 
Route::get('/login_gen/{username}','AppUserController@expert_login_gen'); //
Route::post('/login-new','AppUserController@expert_login_process'); // not done

// SuperAdmin 
Route::get('/panel/superadmin', 'SuperAdminController@index');
Route::get('/panel/superadmin/install', 'SuperAdminController@install');
Route::post('/panel/superadmin/update-password', 'SuperAdminController@update_password');
Route::post('/panel/superadmin/login', 'SuperAdminController@login_process');
Route::get('/panel/superadmin/logout', 'SuperAdminController@logout');

Route::group(['middleware' => ['auth:admins']], function(){
    Route::prefix('/panel/superadmin')->group(function () {
        Route::get('/dashboard', 'SuperAdminController@dashboard');
        Route::get('/row/{id}', 'SuperAdminController@row_details');
        Route::post('/upload','SuperAdminController@img_upload');
        
        // Login Status check
        Route::get('/check', 'SuperAdminController@is_logged_in');

        Route::get('/forgot-password', 'SuperAdminController@forgot_pass');
        Route::post('/forgot-password', 'SuperAdminController@forgot_pass_process');

        Route::get('/forgot/{email}/{code}', 'SuperAdminController@reset_pass');
        Route::post('/reset-password', 'SuperAdminController@reset_pass_process');

        
    });
});