<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::post('/signup','User\UserController@store')->name('signup');

});




	/** Dashboard **/
	Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status']], function () {


		/** HOME **/	
		// Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/home', 'User\HomeController@index')->name('home');
		

		/** USER **/   
		Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
		Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
		Route::post('/user/logout/{slug}', 'UserController@logout')->name('user.logout');
		Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
		Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
		Route::resource('user', 'UserController');


		/** PROFILE **/
		Route::get('/profile', 'ProfileController@details')->name('profile.details');
		Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
		Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
		Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


		/** MENU **/
		Route::resource('menu', 'MenuController');

		//Route::resource('permits', 'User\PermitController');
		//Route::resource('shipping-permits', 'Shared\ShippingPermitController');
		
		Route::get('shipping-permits/my-shipping-permits', 'Shared\ShippingPermitController@userIndex')->name('shipping-permits.my-shipping-permits');
		Route::get('shipping-permits/apply', 'Shared\ShippingPermitController@userShowApply')->name('shipping-permits.apply');

	});

	Route::get('/verify_email','User\UserController@verifyEmail')->name('dashboard.verify_email');

	Route::get('/sendmail', 'User\UserController@sendEmailVerification');
	
	// Route::prefix('dashboard')->group(function(){

	// 	// Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	// 	// Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

	// 	Route::get('/home', 'User\HomeController@index')->name('home');


	// 	//Route::get('/', 'AdminController@index')->name('admin.dashboard');

	// });



	Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware' => ['check.admin_route']], function () {

		

		Route::get('/home', 'Admin\HomeController@index')->name('home');

		Route::resource('menus', 'Admin\MenuController');

		Route::resource('functions','Admin\FunctionController');
		Route::post('functions/add_resource','Admin\FunctionController@add_resource')->name('functions.add_resource');
		//Route::get('/', 'AdminController@index')->name('admin.dashboard');
		Route::resource('users','Admin\UserController');
		Route::resource('admins','Admin\AdminsController');

		Route::get('/test', 'Admin\AdminsController@test')->name('admins.test');

		// Route::resource('shipping-permits', 'Shared\ShippingPermitController');
		//Route::get('admin/shipping-permits','Shared\ShippingPermitController@index');

		Route::get('shipping-permits', 'Shared\ShippingPermitController@index')->name('shipping-permits.index');

	});

	Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

	// Route::group(['prefix' => 'shared', 'as' => 'shared.'], function(){
		
	// });

	// Route::prefix('admin')->as('admin.')->group(function(){

	// 	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
	// 	Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');

	// 	Route::get('/home', 'Admin\HomeController@index')->name('home');

	// 	Route::resource('menus', 'Admin\MenuController');

	// 	Route::resource('functions','Admin\FunctionController');
	// 	Route::post('functions/add_resource','Admin\FunctionController@add_resource')->name('functions.add_resource');
	// 	//Route::get('/', 'AdminController@index')->name('admin.dashboard');
	// 	Route::resource('users','Admin\UserController');
	// 	Route::resource('admins','Admin\AdminsController');
	// });



/** Testing **/
Route::get('/dashboard/test', function(){

	//return dd(Illuminate\Support\Str::random(16));

});

Route::get('/receive', function(){
	return view('test.receive');
});

