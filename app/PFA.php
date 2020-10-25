<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PFA extends Model
{
    protected $table = ['p_f_a_s'];
    protected $fillable = [
        'fullname',
        'abbrev',
        'status', 
    ];

    
}
