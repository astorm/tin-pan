<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function version()
    {
        return $this->hasOne('App\Version');
    }

    public function getVersion()
    {
        return $this->version->version;
    }

    public function getNormalizedVersion($normalizer)
    {
        return $normalizer->normalize($this->getVersion());
    }

    public function getFullName()
    {
        return $this->vendor_name . '/' . $this->package_name;
    }

    public function getDisplayFilename()
    {
        return $this->vendor_name . "-" . $this->package_name . '-' .
            $this->getVersion() . ".zip";
    }

    public function getVersionFromFilename($vendor, $packagename, $filename)
    {
        $startOfName = $vendor . '-' . $packagename . '-';

        $version     = str_replace($startOfName, '', $filename);
        $version     = str_replace('.zip', '', $version);
        return $version;
    }
}
