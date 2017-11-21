<?php

Route::get('/',[
    'uses'=>'homeController@getWelcome',
    'as'=>'home'
]);

Route::get('register',[
    'uses'=>'authController@getRegister',
    'as'=>'register'
]);

Route::get('login',[
    'uses'=>'authController@getLogin',
    'as'=>'login'
]);
Route::get('/getImg/{cover}',[
    'uses'=>'homeController@getImg',
    'as'=>'cover'
]);

Route::get('/add_to_cart/{id}',[
    'uses'=>'homeController@getAddToCart',
    'as'=>'add_to_cart'
]);

Route::get('/clear_cart',[
   'uses'=>'homeController@getClearCart',
    'as'=>'clear-cart'
]);

Route::get('/decrease/{id}',[
   'uses'=>'homeController@getDecrease',
    'as'=>'decrease'
]);

Route::get('/increase/{id}',[
    'uses'=>'homeController@getIncrease',
    'as'=>'increase'
]);

Route::post('/checkout',[
   'uses'=>'homeController@CheckOut',
    'as'=>'checkout'
]);





Route::group(['prefix'=>'auth'],function (){
   Route::post('/post_reg',[
       'uses'=>'authController@postRegister',
       'as'=>'post_reg'
   ]) ;
   Route::post('post_login',[
       'uses'=>'authController@postLogin',
       'as'=>'post_login'
   ]);
   Route::get('/logout',[
       'uses'=>'authController@getLogout',
       'as'=>'logout'
   ]);

});




Route::group(['prefix'=>'admin'],function (){

    Route::group(['middleware'=>'auth'],function (){
        Route::get('/dashboard',[
            'uses'=>'adminController@getDashboard',
            'as'=>'dashboard'
        ]);

        Route::post('/new_data',[
           'uses'=>'adminController@postNewData',
            'as'=>'post_new_data'
        ]);

        Route::get('/order',[
            'uses'=>'adminController@getOrder',
            'as'=>'order'
        ]);

        Route::get('/cash/{id}',[
            'uses'=>'adminController@getCash',
            'as'=>'cash'
        ]);



    });
});