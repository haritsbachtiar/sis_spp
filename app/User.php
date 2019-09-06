<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = ['nis','password','nama','alamat','kelas','jurusan','no_telp'];
    protected $primaryKey = 'id';
}
