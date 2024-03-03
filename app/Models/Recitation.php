<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recitation extends Model
{
    use HasFactory;
    protected $guarded = [];
    function user(){
        return $this -> belongsTo(User::class, 'user_id');
    }
    function week(){
        return $this -> belongsTo(Week::class, 'week_id');
    }
}
