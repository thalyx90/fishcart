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
    	sleep(1);
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

		$user->password = bcrypt($user->password);
		$user->save();

		return redirect('users/'.$user->id);
	});

	Route::get('users/{id}/edit', function ($id) {
		$user = App\Models\User::find($id);
		return view('edituserform',['user'=>$user]);
	})->middleware(['auth']);

	Route::put('users/{id}', function ($id) {
		$user = App\Models\User::find($id);

		if(!Request::ajax()){
			$user->fill(Request::all());
			$user->save();
			return redirect('users/'.$id);
		}else{

			//get column to update
			$column = Request::input('column');
			//get value to update
			$value = Request::input('value');

			$user->$column = $value;
			$user->save();
			return $value;
		}
		
	});



	Route::resource('products', 'ProductController');
	

	Route::get('login', "LoginController@showLoginForm");
	Route::post('login', "LoginController@processLogin");
	Route::get('logout', "LoginController@logout");


	Route::get('cart-items', function () {

		

		return view('showcart');
		
	});
	Route::post('cart-items', function () {

		$product = App\Models\Product::find(Request::input('product_id'));

		$items = array(
		    'id' => $product->id,
		    'name' => $product->name,
		    'price' => $product->price,
		    'quantity' => Request::input('quantity')
		);

		// Make the insert...
		Cart::insert($items);

		return redirect('cart-items');


		
	});
	Route::delete('cart-items/{identifier}', function ($identifier) {

		Cart::item($identifier)->remove();
		
		return redirect('cart-items');

		
	});

	

	Route::post('orders', function () {
		$order = new App\Models\Order();
		$order->user_id = Auth::user()->id;
		$order->status = "Pending";
		$order->save();

		foreach(Cart::contents() as $item){

			$order->products()->attach($item->id,
										["quantity"=>$item->quantity]);
		}

		Cart::destroy();
		return redirect("types/1");
		
	})->middleware(['auth']);


	Route::get('orders', function () {

		$orders = Auth::user()->orders;

		return view("showorders",['orders'=>$orders]);

	})->middleware(['auth']);

	Route::post('photos', function () {

		$image =  'photo' . base_convert(rand(),10,36) . '.jpg';
		Request::file('photo')->move('uploads',$image);
		return $image;

	});


});
