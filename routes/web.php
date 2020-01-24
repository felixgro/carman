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

// Landing Page
Route::get('/', 'WelcomeController@index')->name('landing');

// Basic Dashboard Routes
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/settings', 'DashboardController@index')->name('settings');

// Vehicle Routes
Route::get('/vehicles', 'VehicleController@index')->name('vehicles');
Route::get('/vehicles/new', 'VehicleController@create');
Route::post('/vehicles', 'VehicleController@store');
// Vehicle Middleware (app/Http/Middleware/Expense)
Route::get('/vehicles/{vehicle}/edit', 'VehicleController@edit')->middleware('vehicle');
Route::put('/vehicles/{vehicle}', 'VehicleController@update')->middleware('vehicle');
Route::delete('/vehicles/{vehicle}', 'VehicleController@destroy')->middleware('vehicle');
Route::post('/vehicles/setcurrent', 'VehicleController@setCurrent');
Route::post('/vehicles/setmain/{vehicle}', 'VehicleController@setMain')->middleware('vehicle');

// Route Routes
Route::get('/routes', 'RouteController@index')->name('routes');
// TODO: CRUD Operations
// TODO: Route Middleware (app/Http/Middleware/Route)

// Expenses Routes
Route::get('/expenses', 'ExpenseController@index')->name('expenses');
Route::get('/expenses/new', 'ExpenseController@create');
Route::post('/expenses', 'ExpenseController@store');
// Expense Middleware (app/Http/Middleware/Expense)
Route::get('/expenses/{expense}', 'ExpenseController@show')->middleware('expense');;
Route::get('/expenses/{expense}/edit', 'ExpenseController@edit')->middleware('expense');
Route::put('/expenses/{expense}', 'ExpenseController@update')->middleware('expense');
Route::delete('/expenses/{expense}', 'ExpenseController@destroy')->middleware('expense');

// Dependency Routes
Route::get('/dependencies', 'DependencyController@index')->name('dependencies');
Route::get('/dependencies/new', 'DependencyController@create');
Route::post('/dependencies', 'DependencyController@store');
// TODO: Dependency Middleware (app/Http/Middleware/Dependency)
Route::get('/dependencies/{dependency}', 'DependencyController@show')->middleware('dependency');
Route::get('/dependencies/{dependency}/edit', 'DependencyController@edit')->middleware('dependency');
Route::put('/dependencies/{dependency}', 'DependencyController@update')->middleware('dependency');
Route::delete('/dependencies/{dependency}', 'DependencyController@destroy')->middleware('dependency');

Auth::routes();
/*
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                    | Name             | Action                                                                 | Middleware   |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD | api/user               |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST     | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | GET|HEAD | password/confirm       | password.confirm | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth     |
|        | POST     | password/confirm       |                  | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth     |
|        | POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web          |
|        | GET|HEAD | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web          |
|        | POST     | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web          |
|        | GET|HEAD | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web          |
|        | GET|HEAD | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST     | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
*/