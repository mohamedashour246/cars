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

//Route::get('/', function () {
//    return view('admin.layouts.app');
//});
//Route::view('login','login');
//Route::view('register','register');

Route::get('/register',[
    'uses' => 'Admin\UserController@register',
    'as' => 'register'
]);

Route::post('/register/post',[
    'uses' => 'Admin\UserController@postRegister',
    'as' => 'register.post'
]);

Route::get('/',[
      'uses' => 'Admin\UserController@getLogin',
      'as' => 'login'
]);

Route::post('/login/post',[
      'uses' => 'Admin\UserController@postLogin',
      'as' => 'login.post'
]);

Route::group(['namespace' =>'Admin', 'prefix' => 'dashboard' ,'middleware' => 'auth'], function (){

      Route::get('/',[
           'uses' => 'UserController@getUsers',
           'as' => 'admin.users'
      ]);

      Route::get('/profile',[
           'uses' => 'UserController@getProfile',
           'as' => 'admin.user.profile'
      ]);

      #pages
      Route::get('/page',[
           'uses' => 'PageController@getPage',
           'as' => 'admin.pages'
      ]);

      Route::get('/page/create',[
          'uses' => 'PageController@addPage',
          'as' => 'admin.pages.add'
      ]);

      Route::post('/page/post',[
           'uses' => 'PageController@postPage',
           'as' => 'admin.pages.post'
      ]);

      Route::get('/page/edit/{id}',[
        'uses' => 'PageController@editPage',
        'as' => 'admin.pages.edit'
      ]);

      Route::post('/page/update/{id}',[
        'uses' => 'PageController@updatePage',
        'as' => 'admin.pages.update'
      ]);

      Route::get('/page/delete/{id}',[
        'uses' => 'PageController@deletePage',
        'as' => 'admin.pages.delete'
      ]);

    #subpages
    Route::get('/subpage',[
        'uses' => 'SubPageController@getSubPage',
        'as' => 'admin.subpages'
    ]);

    Route::get('/subpage/create',[
        'uses' => 'SubPageController@addSubPage',
        'as' => 'admin.subpages.add'
    ]);

    Route::post('/subpage/post',[
        'uses' => 'SubPageController@postSubPage',
        'as' => 'admin.subpages.post'
    ]);

    Route::get('/subpage/edit/{id}',[
        'uses' => 'SubPageController@editSubPage',
        'as' => 'admin.subpages.edit'
    ]);

    Route::post('/subpage/update/{id}',[
        'uses' => 'SubPageController@updateSubPage',
        'as' => 'admin.subpages.update'
    ]);

    Route::get('/subpage/delete/{id}',[
        'uses' => 'SubPageController@deleteSubPage',
        'as' => 'admin.subpages.delete'
    ]);

    #links
    Route::get('/link',[
        'uses' => 'LinkController@getLink',
        'as' => 'admin.links'
    ]);

    Route::get('/link/create',[
        'uses' => 'LinkController@addLink',
        'as' => 'admin.links.add'
    ]);

    Route::post('/link/post',[
        'uses' => 'LinkController@postLink',
        'as' => 'admin.links.post'
    ]);

    Route::get('/link/edit/{id}',[
        'uses' => 'LinkController@editLink',
        'as' => 'admin.links.edit'
    ]);

    Route::post('/link/update/{id}',[
        'uses' => 'LinkController@updateLink',
        'as' => 'admin.link.update'
    ]);

    Route::get('/link/delete/{id}',[
        'uses' => 'LinkController@deleteLink',
        'as' => 'admin.link.delete'
    ]);

    #contact
    Route::get('/contact',[
        'uses' => 'ContactUsController@getContact',
        'as' => 'admin.contact'
    ]);

    // Route::get('/contact/create',[
    //     'uses' => 'ContactUsController@addContact',
    //     'as' => 'admin.contact.add'
    // ]);

    // Route::post('/contact/post',[
    //     'uses' => 'ContactUsController@postContact',
    //     'as' => 'admin.contact.post'
    // ]);

    Route::get('/contact/edit/{id}',[
        'uses' => 'ContactUsController@editContact',
        'as' => 'admin.contact.edit'
    ]);

    Route::post('/contact/update/{id}',[
        'uses' => 'ContactUsController@updateContact',
        'as' => 'admin.contact.update'
    ]);


});
