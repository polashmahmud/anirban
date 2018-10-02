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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//// Registration Routes...
//if ($options['register'] ?? true) {
//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'Auth\RegisterController@register');
//}
//
//// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('package', 'PackageController');
    Route::resource('account', 'AccountController');
    Route::resource('collection', 'CollectionController');
    Route::resource('debit-credit', 'DebitCreditController');
    Route::resource('transfer-amount', 'TransferAmountController');

    // Helper Controller
    Route::post('status-change', 'HelperController@statusChange')->name('status-change');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('mobile')->group(function () {
    Route::get('login', 'Mobile\AuthController@showLoginForm')->name('mobile.login');
    Route::post('login', 'Mobile\AuthController@login');
    Route::get('dashboard', 'Mobile\DashboardController@index')->name('mobile.dashboard');
    Route::get('investment', 'Mobile\InvestmentController@index')->name('mobile.investment');
    Route::get('investment/{id}', 'Mobile\InvestmentController@show')->name('mobile.investment.show');
    Route::get('lone', 'Mobile\LoneController@index')->name('mobile.lone');
    Route::get('saving', 'Mobile\SavingController@index')->name('mobile.saving');
    Route::get('new-account', 'Mobile\NewAccountController@index')->name('mobile.new.account');
    Route::get('money-transfer', 'Mobile\MoneyTransferController@index')->name('mobile.money.transfer');
    Route::get('debit-credit', 'Mobile\DebitCreditController@index')->name('mobile.debit.credit');
});

