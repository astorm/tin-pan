<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class ServePackage extends Controller
{    
    public function execute()
    {
        return response()->download(
            base_path('releases/pulsestorm-magento2-hello-world.zip'));    
    }
}