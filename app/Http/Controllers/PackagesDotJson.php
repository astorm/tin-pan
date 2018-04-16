<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class PackagesDotJson extends Controller
{
    public function execute()
    {
        return response()->json([
            'packages' => [],
            'includes' => [
                "include/all\$ca849c8894d293113b16b713878ee8a917f17b08.json"=>[
                    "sha1"=>"ca849c8894d293113b16b713878ee8a917f17b08"
                ]
            ]        
        ]);    
    }
}