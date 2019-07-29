<?php

// login, logout, register, password/reset
Auth::routes();

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

//$pack = 1, $size = 128
//        return view('experimental.stickers', compact('pack', 'size'));
//Route::get('/vk/stickers/{pack?}/{size?}', 'Experimental@stickers')
//    ->where(['pack'=> '\d+', 'size'=> '\d+'])
//    ->name('stickers');

//Route::get('/profile{any}', function () {
//    return view('profile', []);
//})->where('any', '.*')->name('profile');
//
//Route::get('/{root}', function () {
//    return view('main', []);
//})->where('root', '|nabla|chapters')->name('main');
//Route::post('/term', 'Terminal@endpoint')->name('term');
//
//Route::get('/docs{any}', function () {
//    return view('docs', []);
//})->where('any', '.*')->name('docs');
//
//Route::get('/map{any}', function () {
//    return view('map', []);
//})->where('any', '.*')->name('map');
//
//Route::get('/map/observer', 'Main@observer')->name('observer');



//uitest:
//path:     /uitest
//    defaults: { _controller: UnitBundle:Default:uiTest }
//chain:
//    path:     /chain
//    defaults: { _controller: UnitBundle:Default:chain }
//single:
//    path:     /single/{name}
//    defaults: { _controller: UnitBundle:Default:single }
//run:
//    path:     /run/{name}
//    defaults: { _controller: UnitBundle:Default:run }


//units:
//path:     /units/{unitId}
//    methods:  GET
//    defaults: { _controller: AdminBundle:Unit:index, unitId:null }
//edit_unit:
//    path:     /units/post
//    methods:  POST
//    defaults: { _controller: AdminBundle:Unit:post }
