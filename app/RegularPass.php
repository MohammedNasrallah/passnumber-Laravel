<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RegularPass extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = false;
    public function getAuthPassword(){
        return $this->regularpass;
    }

}
