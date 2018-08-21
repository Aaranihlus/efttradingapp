<?php



Route::get('/', 'HomeController@index');

Route::get('/offers', 'OfferController@index');
Route::get('/offer/{offer}', 'OfferController@show');
Route::get('/offer', 'OfferController@create');
Route::post('/offer', 'OfferController@store');

Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@store');
Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@loginuser');
Route::get('/logout', 'AuthController@logout');

//Returns All Items
Route::get('/items/all', 'ItemController@AllItems');
//Returns all Items in the specified sub category
Route::get('/items/subcat/{sub_category}', 'ItemController@CategoryItems');
//returns all sub categories in specified main category
Route::get('/items/bymain/{main_category}', 'ItemController@SubCategoriesByMainCategory');
//Returns All main categories
Route::get('/items/main', 'ItemController@MainCategories');
//returns all sub categories
Route::get('/items/sub', 'ItemController@SubCategories');



//returns the selling/buying data for this item for this user
Route::get('/items/user/selling/{item}', 'UserController@UserSellingItem');
Route::get('/items/user/buying/{item}', 'UserController@UserBuyingItem');


Route::post('/user/update_selling', 'UserController@UpdateSelling');
Route::post('/user/update_buying', 'UserController@UpdateBuying');




Route::get('/item/{item}', 'ItemController@ItemListings');

Route::get('/profile', 'UserController@myProfile');

//Route::post('/profile/items', 'UserController@UpdateItem');

Route::get('/profile/{username}', 'UserController@showProfile');
