<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

    $type = App\Models\Type::find(2);
    return view('productlist',['type'=>$type]);
});




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('types/{id}', function ($id) {
		$type = App\Models\Type::find($id);
	    return view('productlist',['type'=>$type]);
	});

	Route::get('users/create', function () {
		return view('registerform');
	});

	Route::get('users/{id}', function ($id) {
		$user = App\Models\User::find($id);
	    return view('userdetails',['user'=>$user]);
	});

	Route::post('users', function (App\Http\Requests\CreateUserRequest $req) {
		$user = App\Models\User::create(Request::all());
		return redirect('users/'.$user->id);
	});

	Route::get('users/{id}/edit', function ($id) {
		$user = App\Models\User::find($id);
		return view('edituserform',['user'=>$user]);
	});

	Route::put('users/{id}', function (App\Http\Requests\EditUserRequest $req,$id) {
		$user = App\Models\User::find($id);
		$user->fill(Request::all());
		$user->save();
		return redirect('users/'.$id);
	
	});
});
