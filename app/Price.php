<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //
    protected $fillable = ['kelas','jurusan','formulir','spp','uang_pengembangan'];
    protected $primaryKey = 'id';
}
