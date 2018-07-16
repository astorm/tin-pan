<?php
namespace App\Helper;
class LoadUser
{
    public function load($identifier)
    {
        return \App\User::where('email','=',$identifier)->first();
    }
}
