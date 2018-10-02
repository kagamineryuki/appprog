<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tblAdmin extends Authenticatable
{
    protected $guard = 'admin';
    protected $primaryKey = 'no_pegawai';
    public $timestamps = false;
    public $incrementing = false;
}
