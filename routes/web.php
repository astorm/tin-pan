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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dist/pulsestorm/magento2-hello-world/pulsestorm-magento2-hello-world.zip',function() {
    return response()->download(
        base_path('releases/pulsestorm-magento2-hello-world.zip'));
});

Route::get('include/all$ca849c8894d293113b16b713878ee8a917f17b08.json', function() {
    $json = '
    {
        "packages": {
            "pulsestorm/magento2-hello-world": {
                "dev-master": {
                    "name": "pulsestorm/magento2-hello-world",
                    "version": "dev-master",
                    "version_normalized": "9999999-dev",
                    "dist": {
                        "type": "zip",
                        "url": "http://composer.pulsestorm.dynamic/dist/pulsestorm/magento2-hello-world/pulsestorm-magento2-hello-world.zip",
                        "shasum": "cfd4935d4f222664b43b11fd533715ecd79a6c2f"
                    },
                    "time": "2016-04-19T21:39:58+00:00",
                    "type": "library",
                    "installation-source": "dist",
                    "license": [
                        "MIT"
                    ],
                    "description": "A simple Hello World model for Magento 2 MVVM (or MVVM like) system.",
                    "support": {
                        "source": "https://github.com/astorm/magento2-hello-world/tree/master",
                        "issues": "https://github.com/astorm/magento2-hello-world/issues"
                    }
                }
            }
        }
    }';
    return response()->json(json_decode($json));
});

Route::get('/packages.json', function() {
    return response()->json([
        'packages' => [],
        'includes' => [
            "include/all\$ca849c8894d293113b16b713878ee8a917f17b08.json"=>[
                "sha1"=>"ca849c8894d293113b16b713878ee8a917f17b08"
            ]
        ]        
    ]);
});