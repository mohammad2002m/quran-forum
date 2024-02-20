<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    function supervisor(){
        return $this -> belongsTo(User::class, 'supervisor_id');
    }
    function students(){
        return $this -> hasMany(User::class);
    }
}
