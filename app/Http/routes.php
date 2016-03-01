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

// Route::get('/', function () {

//     $type = App\Models\Type::find(2);
//     return view('productlist',['type'=>$type]);
// });




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

	Route::get('/', function () {

	    dd(Cart::contents());
	});




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
	})->middleware(['auth','auth.user']);

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

	Route::put('users/{id}', function (App\Http\Requests\EditUserRequest $req,$id) {
		$user = App\Models\User::find($id);
		$user->fill(Request::all());
		$user->save();
		return redirect('users/'.$id);
	
	})->middleware(['auth']);

	//creates a product
    Route::get('products/create', function () { 
        return view('createproductform');
    })->middleware(['auth']);
    
    //post data from form to the data base
    Route::post('products', function (App\Http\Requests\CreateProductRequest $req) { 
        $product = App\Models\Product::create($req->all());

        $newName = "photo".$product->id.".jpg";
        Request::file("photo")->move("productphotos",$newName);

        $product->photo = $newName;
        $product->save();

        return redirect('types/'.$product->type->id);

    })->middleware(['auth']);
    
    
    // loads data into update form
    Route::get('products/{id}/edit', function ($id) { 
        $product = App\Models\Product::find($id);
        return view('editproductform',['product'=>$product]);
    })->middleware(['auth']);
    
        // checks info then saves
    Route::put('products/{id}', function(App\Http\Requests\EditProductRequest $req, $id) { 
         $product = App\Models\Product::find($id);
         $product->fill(Request::all());
        $product->save();
        return redirect('types/1');
        
    })->middleware(['auth']);


	Route::get('login', function () {
		return view("loginform");
	});

	Route::post('login', function (App\Http\Requests\LoginRequest $req) {
		//get credential
		$credential = $req->only("username","password");

		//ask Authenticator to check
		if(Auth::attempt($credential)){
			return redirect("types/1");
		}else{
			return redirect("login")->with("message","Try again!");
		}

	});

	Route::get('logout', function () {

		//log you out
		Auth::logout();
		//redirect to login
		return redirect("login");
		
	});

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

	Route::get('products/{id}', function ($id) {

		$product = App\Models\Product::find($id);
		return view('showproduct',['product'=>$product]);
		
	});

	// Route::post('login', function () {

	// 	$credential = Request::only("username","password");

 //    	if(Auth::attempt($credential)){

 //    		//can login
 //    		return redirect('types/1');

 //    	}else{
 //    		return redirect("login")->with("message","Try again!");
 //    	}
	// });

});
