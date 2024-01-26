<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, HasApiTokens, HasFactory, Notifiable;
    function announcements(){
        return $this -> hasMany(Announcement::class);
    }
    function roles(){
        return $this -> hasMany(Role::class);
    }
}
