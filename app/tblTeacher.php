<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tblTeacher extends Authenticatable
{
    protected $primaryKey = 'nign';
    protected $guard = 'student';
    public $timestamps = false;
}
