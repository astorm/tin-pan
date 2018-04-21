<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    public function getNormalizedVersion($normalizer)
    {
        return $normalizer->normalize($this->version);
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
