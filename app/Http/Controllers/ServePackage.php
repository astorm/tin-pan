<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class ServePackage extends Controller
{
    protected $package;
    public function __construct(\App\Package $package)
    {
        $this->package = $package;
    }

    public function execute($vendor, $packagename, $filename)
    {
        $version = $this->package->getVersionFromFilename($vendor, $packagename, $filename);

        $package = $this->package->where('package_name','=', $packagename)
            ->where('vendor_name','=', $vendor)
            ->whereHas('version', function($query) use ($version) {
                $query->where('version','=', $version);
            })->first();

        return response()->download(
            base_path('releases/'.$package->version->filename_on_system));
    }
}
