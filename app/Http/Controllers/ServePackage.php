<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $version = $this->package->getVersionFromFilename($vendor, $packagename, $filename, $user);
        $version = $this->version->where('version', '=', $version)
            ->whereHas('package', function($query) use ($packagename, $vendor, $user) {
                $query->where('package_name','=', $packagename)
                    ->where('vendor_name','=', $vendor)
                    ->whereHas('users', function($query) use ($user){
                        $query->where('user_id', '=', $user->id);
                    });
            })->first();

        if(!$user || !$version)
        {
            return $this->reject();
        }

        return response()->download(
            base_path('releases/'.$version->filename_on_system));
    }

    protected function reject()
    {
        return response()->json(['error' => 'Forbidden.'], 403);
    }
}
