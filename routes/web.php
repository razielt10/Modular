<?php
session_start();
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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/admin', 'HomeController@index')->name('admin');

//for login with Fb or G
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('callbackgoogle', 'Auth\LoginController@handleProviderCallback');




//users module
Route::get('/security/users{param?}', 'UsersController@index')
  ->name('users.index')->middleware('auth');
Route::get('/security/users/create', 'UsersController@create')
  ->name('users.create')->middleware('auth');
Route::get('/security/users/{id}/edit', 'UsersController@edit')
  ->name('users.edit')->middleware('auth');
Route::get('/security/users/{id}/modules', 'UsersController@showModules')
  ->name('users.modules')->middleware('auth');
Route::put('/security/users/{id}/modules', 'UsersController@storeModules')
  ->name('users.modulesStore')->middleware('auth');
//find an user by username()
Route::get('/security/users/validateNewDuplicated',
  'UsersController@validateNewDuplicated')->middleware('auth');

Route::post('/security/users', 'UsersController@store')
  ->name('users.store')->middleware('auth');
Route::post('/security/users/{id}', 'UsersController@update')
  ->name('users.update')->middleware('auth');





//masters modules
Route::prefix('/masters')->middleware(['auth'])->group(function () {

  //categories master module
  Route::get('categories{param?}', 'CategoriesController@index')->name('categories.index');
  Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
  Route::get('categories/validateNewDuplicated', 'CategoriesController@validateNewDuplicated');
  Route::post('categories', 'CategoriesController@store')->name('categories.store');

  Route::get('categories/{id}/edit', 'CategoriesController@edit')->name('categories.edit');




  //products master module
  Route::get('products{param?}', 'ProductsController@index')
  ->name('products.index');





  //Personal File master module
  Route::get('personalfile{param?}',
   'PersonalFileController@index')->name('personalfile.index');
  Route::get('personalfile/create',
   'PersonalFileController@create')->name('personalfile.create');
  Route::get('personalfile/findByPersonalID',
   'PersonalFileController@findByPersonalID');
  Route::get('personalfile/findByForeignID',
   'PersonalFileController@findByForeignID');

  Route::post('personalfile/step1',
   'PersonalFileController@storePersonalFile')->name('personalfile.storePF');
  Route::post('personalfile/step2',
   'PersonalFileController@storeForeignFile')->name('personalfile.storeFF');


 Route::patch('personalfile/step1',
  'PersonalFileController@updatePF')->name('personalfile.updatePF');
 Route::patch('personalfile/step2',
  'PersonalFileController@updateFF')->name('personalfile.updateFF');

 Route::post('personalfile/stepContact',
  'PersonalFileController@storeContact')->name('personalfile.stepContact');

  Route::get('personalfile/{id}/edit',
   'PersonalFileController@edit')->name('personalfile.edit');

  //reports
  Route::get('personalfile/{id}/reportPersonalFile',
   'ReportsController@reportPersonalFile')
   ->name('personalfile.reports.reportPersonalFile');

  //states
  Route::get('states/byCountry' , 'StatesController@byCountry')
  ->name('states.json');

  //countrys
  Route::get('countrys/allCountrys' , 'CountrysController@allCountrys')
  ->name('countrys.json');

  //Relationship
  Route::get('relationship/allRelations' , 'RelationshipController@allRelations')
  ->name('relationship.json');

  //immigrationsituation
  Route::get('immigrationsituation/jsonById' ,
   'ImmigrationSituationController@jsonById')->name('immsit.json');

}) ;





//movies controller
Route::prefix('/movies')->middleware(['auth'])->group(function () {

//form for new movie
  Route::get('/add', 'MovieController@create')->name('movies.add')
    ->middleware('auth');

//form for edit movie
  Route::get('/{id}/edit', 'MovieController@getById')->name('movies.edit')
    ->middleware('auth');

//update the movie
  Route::post('/{id}', 'MovieController@update')->name('movies.save')
    ->middleware('auth');

//list or index for movies
  Route::get('/', 'MovieController@list')->name('movies.list')
    ->middleware('auth');

//save the new movie
  Route::post('/', 'MovieController@store')->name('movies.store')
    ->middleware('auth');

});



//path general, dont change
Route::get('/', 'SiteController@index')->name('site');
