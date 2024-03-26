<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $guarded = [];
    function user(){
        return $this -> belongsTo(User::class);
    }
    function image(){
        return $this -> belongsTo(Image::class);
    }
}
