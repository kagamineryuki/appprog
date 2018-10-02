<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tblStudent extends Authenticatable
{
    protected $primaryKey = 'nisn';
    protected $guard = 'student';
    public $timestamps = false;
}
