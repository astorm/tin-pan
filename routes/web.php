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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('dist/pulsestorm/magento2-hello-world/pulsestorm-magento2-hello-world.zip', 'ServePackage@execute')
    ->middleware('auth.basic');

Route::get('include/all$ca849c8894d293113b16b713878ee8a917f17b08.json', 'IncludeDotJson@execute');

Route::get('/packages.json', 'PackagesDotJson@execute');

// Auth::routes();
