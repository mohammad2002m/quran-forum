<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;
    protected $guarded = [];
    function recitations(){
        return $this -> hasMany(Recitation::class);
    }
}
