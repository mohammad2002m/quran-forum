<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];
    static function get($key){
        $record = Settings::where('key', $key) -> first();
        if ($record){
            return $record -> value;
        }
        return null;
    }
    static function set($key, $value){
        $setting = Settings::where('key', $key) -> first();
        if ($setting){
            $setting -> value = $value;
            $setting -> save();
        }else{
            Settings::create(['key' => $key, 'value' => $value]);
        }
    }
}
