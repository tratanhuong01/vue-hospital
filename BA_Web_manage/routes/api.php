<?php

use App\Http\Controllers\C_blog;
use App\Http\Controllers\C_book_list;
use App\Http\Controllers\User\C_User;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/admin-register', 'Admin\C_Admin@register');
Route::post('/admin-login', 'Admin\C_Admin@login');
Route::get('/admin-information', 'Admin\C_Admin@adminAuth')->middleware(['auth:api_admin', 'scopes:admin']);

//admin 
Route::get('/doctors', 'Admin\C_Admin@getDoctor');
Route::get('/doctor-admin', 'Admin\C_Admin@getDoctorAdmin');
Route::post('/doctor-search', 'Admin\C_Admin@searchAdmin');
Route::post('/doctor-slug', 'Admin\C_Admin@getDoctorBySlug');
Route::post('/doctors', 'Admin\C_Admin@addDoctor');
Route::put('/doctors', 'Admin\C_Admin@updateDoctor');
Route::get('/doctors/{id}', 'Admin\C_Admin@getDoctorById');
Route::delete('/doctors/{id}', 'Admin\C_Admin@deleteDoctor');

//user
Route::post('user-search', 'User\C_User@searchUser');
Route::post('/user-register-check', 'User\C_User@confirmEmail');
Route::post('/user-register', 'User\C_User@register');
Route::post('/user-login', 'User\C_User@login');
Route::post('/user-avatar', 'User\C_User@updateAvatar');
Route::get('/user-information', 'User\C_User@userAuth')->middleware(['auth:api_user', 'scopes:user']);
Route::get("/users", 'User\C_User@getAllUser');
Route::put("/users", 'User\C_User@updateUser');

// specicallist
Route::get('/specicallists/{id}', 'C_specical_list@getSpecicalListById');
Route::post('/specicallist-slug', 'C_specical_list@getSpecicalListBySlug');
Route::post('/specicallist-search', 'C_specical_list@searchSpecicalList');
Route::get('/specicallists', 'C_specical_list@getSpecicalList');
Route::post('/specicallists', 'C_specical_list@addSpecicalList');
Route::put('/specicallists', 'C_specical_list@updateSpecicalList');
Route::delete('/specicallists/{id}', 'C_specical_list@deleteSpecicalList');

//time book
Route::post('/timebook-search', 'C_time_book@searchTimeBook');
Route::get('/timebooks', 'C_time_book@getAllTimeBook');
Route::get('/timebooks/{id}', 'C_time_book@getTimeBookById');
Route::post('/timebooks', 'C_time_book@addTimeBook');
Route::put('/timebooks', 'C_time_book@updateTimeBook');
Route::delete('/timebooks/{id}', 'C_time_book@deleteTimeBook');

//book list
Route::get('/booklists', 'C_book_list@getAllBookList');
Route::get('/booklist-limit', 'C_book_list@getBookListLimit');
Route::get('/booklists/{id}', 'C_book_list@getBookListById');
Route::get('/booklist-user/{iduser}', 'C_book_list@getBookListByIdUser');
Route::post('/booklists', 'C_book_list@addBookList');
Route::put('/booklists', 'C_book_list@addBookList');
Route::delete('/booklists', 'C_book_list@deleteBookList');
Route::post('/booklist-status', 'C_book_list@updateStatus');

// upload 
Route::post('/uploadImage', 'C_upload@upload');
Route::post('/deleteImage', 'C_upload@delete');

// time doctor 
Route::get('/timedoctors', 'C_time_doctor@getAllTimeDoctor');
Route::get('/timedoctors/{id}', 'C_time_doctor@getTimeDoctorByIdDoctor');
Route::post('/timedoctors', 'C_time_doctor@addTimeDoctor');
Route::put('/timedoctors', 'C_time_doctor@editTimeDoctor');
Route::post('/timedoctor-delete', 'C_time_doctor@deleteTimeDoctor');

//blog
Route::get("/blog-user/{type}", 'C_blog@getBlogByType');
Route::get('/blogs/{id}', 'C_blog@getBlogById');
Route::get('/blogs', 'C_blog@getBlog');
Route::post('/blog-slug', 'C_blog@getBlogBySlug');
Route::post('/blog-different', 'C_blog@getBlogDifferentSlug');
Route::post('/blog-search', 'C_blog@searchBlog');
Route::post('/blogs', 'C_blog@addBlog');
Route::put('/blogs', 'C_blog@editBlog');
Route::delete('/blogs/{id}', 'C_blog@deleteBlog');
Route::get('/update-view-blog/{id}', 'C_blog@updateViewBlog');

//dashboard 
Route::get('/dashboard', function () {
    $cUser = new C_User;
    $cBlog = new C_blog;
    $cBookList = new C_book_list;
    $user = $cUser->getAllUser();
    $blog = $cBlog->getBlog();
    $bookList = $cBookList->getAllBookList();
    return response()->json([
        'user' => $user,
        'blog' => $blog,
        'bookList' => $bookList
    ]);
});


// address 
Route::get('provinces', 'C_address@getProvince');
Route::post('districts', 'C_address@getDistrictByProvince');
Route::post('wards', 'C_address@getWardByDistrict');

// group chat
Route::get('groupChats', 'C_group_chat@getGroupChat');
Route::post('groupChats', 'C_group_chat@addGroupChat');

// chat
Route::get('chats/{idgroupchat}', 'C_chat@getChat');
Route::post('chats', 'C_chat@addChat');