<?php
namespace App\Helper;
class LoadPackage
{
    public function load($identifier)
    {
        $parts = explode('/', $identifier);
        $vendor_name = array_shift($parts);
        $package_name = array_shift($parts);

        return \App\Package::where('package_name','=',$package_name)
            ->where('vendor_name','=',$vendor_name)->first();
    }
}
