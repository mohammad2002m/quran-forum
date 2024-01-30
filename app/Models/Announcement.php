<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    function user(){
        return $this -> belongsTo(User::class);
    }
    function images(){
        return $this -> hasMany(Image::class) -> get() -> toArray();
    }
}
