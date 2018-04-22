<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function versions()
    {
        return $this->hasMany('App\Version');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
//     public function getVersion()
//     {
//         return $this->version->version;
//     }

    public function getFullName()
    {
        return $this->vendor_name . '/' . $this->package_name;
    }

    public function getDisplayFilename($version)
    {
        return $this->vendor_name . "-" . $this->package_name . '-' .
            $version->version . ".zip";
    }

    public function getVersionFromFilename($vendor, $packagename, $filename)
    {
        $startOfName = $vendor . '-' . $packagename . '-';

        $version     = str_replace($startOfName, '', $filename);
        $version     = str_replace('.zip', '', $version);
        return $version;
    }
}
