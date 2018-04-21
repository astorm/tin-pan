<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class ServePackage extends Controller
{
    protected $package;
    public function __construct(\App\Package $package, \App\Version $version)
    {
        $this->package = $package;
        $this->version = $version;
    }

    public function execute($vendor, $packagename, $filename)
    {
        $version = $this->package->getVersionFromFilename($vendor, $packagename, $filename);
        $version = $this->version->where('version', '=', $version)
            ->whereHas('package', function($query) use ($packagename, $vendor) {
                $query->where('package_name','=', $packagename)
                    ->where('vendor_name','=', $vendor);
            })->first();

        return response()->download(
            base_path('releases/'.$version->filename_on_system));
    }
}
