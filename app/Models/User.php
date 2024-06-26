<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Notifications\CustomPasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use QF\Constants;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /** it's ok because I don't user mass assignment from the requets  **/
    protected $guarded = [];

    function announcements(){
        return $this -> hasMany(Announcement::class);
    }
    function roles(){
        return $this -> belongsToMany(Role::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordResetNotification($token));
    }
    function parts(){
        return $this -> hasMany(Part::class);
    }
    function previous_parts(){
        return $this -> hasMany(PreviousPart::class);
    }
    function group()
    {
        return $this -> belongsTo(Group::class);
    }
    function monitoring_groups(){
        return $this -> hasMany(Group::class, 'monitor_id');
    }
    function cover_image(){
        return $this -> hasOne(Image::class, 'id', 'cover_image_id');
    }
    function profile_image(){
        return $this -> hasOne(Image::class, 'id', 'profile_image_id');
    }
    function college(){
        return $this -> hasOne(College::class, 'id', 'college_id');
    }
    function recitations(){
        return $this -> hasMany(Recitation::class);
    }
    function supervisor(){
        return $this -> hasOneThrough(User::class, Group::class, 'id', 'id', 'group_id', 'supervisor_id');
    }

    function parts_before(){
        return $this-> hasMany(PreviousPart::class);
    }

    function is_studnet(){
        return $this -> roles() -> where('name', Constants::ROLE_STUDENT) -> exists();
    }

}