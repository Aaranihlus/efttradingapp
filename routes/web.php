<?php


//Home page
Route::get('/', 'HomeController@index');

//User Offers
Route::get('/offers', 'OfferController@index');

//Show a specific offer
Route::get('/offer/{offer}', 'OfferController@show');

//Create a new offer
Route::post('/offer', 'OfferController@store');

//Show registration page
Route::get('/register', 'AuthController@register');

//Create new account
Route::post('/register', 'AuthController@store');

//Show login form
Route::get('/login', 'AuthController@login');

//Attempt to log the user in
Route::post('/login', 'AuthController@loginuser');

//log the user out
Route::get('/logout', 'AuthController@logout');

//Returns All Items
Route::get('/items/all', 'ItemController@AllItems');

//Returns all Items in the specified sub category
Route::get('/items/subcat/{sub_category}/{main_category}', 'ItemController@CategoryItems');

//returns all sub categories in specified main category
Route::get('/items/bymain/{main_category}', 'ItemController@SubCategoriesByMainCategory');

//Returns All main categories
Route::get('/items/main', 'ItemController@MainCategories');

//returns all sub categories
Route::get('/items/sub', 'ItemController@SubCategories');

//returns the selling/buying data for this item for this user
Route::get('/items/user/selling/{item}', 'UserController@UserSellingItem');

Route::get('/items/user/buying/{item}', 'UserController@UserBuyingItem');

//Update the users buying items
Route::post('/user/update_selling', 'UserController@UpdateSelling');

//Update the users selling items
Route::post('/user/update_buying', 'UserController@UpdateBuying');

//Show listings for a specific item
Route::get('/item/{item}', 'ItemController@ItemListings');

//Show the current users profile
Route::get('/profile', 'UserController@myProfile');

//Show another profile
Route::get('/profile/{username}', 'UserController@showProfile');


Route::post('/send_offer_message', 'OfferController@sendMessage');

Route::post('/close_offer', 'OfferController@closeOffer');

Route::post('/complete_offer', 'OfferController@completeOffer');

Route::post('/review_offer', 'OfferController@reviewOffer');

Route::get('/admin', 'AdminController@home');
