<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class IncludeDotJson extends Controller
{
    public function execute()
    {
        $json = [
            "packages" => [
                "pulsestorm/magento2-hello-world"=>[
                    "dev-master"=>[
                        "name"=>"pulsestorm/magento2-hello-world",
                        "version"=>"dev-master",
                        "version_normalized"=>"9999999-dev",
                        "dist"=>[
                            "type"=>"zip",
                            "url"=>"http://composer.pulsestorm.dynamic/dist/pulsestorm/magento2-hello-world/pulsestorm-magento2-hello-world.zip"
                        ],
                        "time"=>"2016-04-19T21:39:58+00:00",
                        "type"=>"library",
                        "installation-source"=>"",
                        "license"=>"commercial",
                        "description"=>"A simple Hello World model for Magento 2 MVVM (or MVVM like) system.",
                        "support"=>[
                            "source"=>"https://example.com/support",
                            "issues"=>"https://example.com/issues"
                        ]
                    ]
                ]
            ]
        ];
//         $json = '
//         {
//             "packages": {
//                 "pulsestorm/magento2-hello-world": {
//                     "dev-master": {
//                         "name": "pulsestorm/magento2-hello-world",
//                         "version": "dev-master",
//                         "version_normalized": "9999999-dev",
//                         "dist": {
//                             "type": "zip",
//                             "url": "http://composer.pulsestorm.dynamic/dist/pulsestorm/magento2-hello-world/pulsestorm-magento2-hello-world.zip",
//                             "shasum": "cfd4935d4f222664b43b11fd533715ecd79a6c2f"
//                         },
//                         "time": "2016-04-19T21:39:58+00:00",
//                         "type": "library",
//                         "installation-source": "dist",
//                         "license": [
//                             "MIT"
//                         ],
//                         "description": "A simple Hello World model for Magento 2 MVVM (or MVVM like) system.",
//                         "support": {
//                             "source": "https://github.com/astorm/magento2-hello-world/tree/master",
//                             "issues": "https://github.com/astorm/magento2-hello-world/issues"
//                         }
//                     }
//                 }
//             }
//         }';
        return response()->json($json);
    }
}