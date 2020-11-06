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
// Pameran KUI (Karya Untuk Indonesia)

// Guest
Route::get('/', function () {
    return view('landing');
});


// pengunjung
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/galeri', 'HomeController@show_galeri')->name('galeri');
Route::get('/galeri/detail/{id}', 'HomeController@show_galeri_detail')->name('galeri_detail');


// Admin
Route::group(['middleware'=>'isAdmin'],function(){
    Route::get('/karya/create', 'HomeController@create_karya')->name('create_karya');
    Route::post('/karya/create', 'HomeController@insert_karya')->name('insert_karya');
    Route::get('/karya/edit/{id}', 'HomeController@edit_karya_show')->name('edit_karya_show');
    Route::post('/karya/edit', 'HomeController@edit_karya')->name('edit_karya');
    Route::delete('/karya/hapus/{id}', 'HomeController@hapus_karya')->name('hapus_karya');
    
    
    // Seniman
    Route::group(['middleware'=>'isSuperAdmin','middleware'=>'isAdmin'],function(){
        });
});
