<?php
 

Route::get('/', "Product\ProductsController@index")->name("product.index");
Route::post('/products', "Product\ProductsController@store")->name("product.store");
