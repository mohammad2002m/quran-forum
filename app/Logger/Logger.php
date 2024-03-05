<?php

use App\Models\SystemLog;

class QFLogger
{
    const ERROR = 'error';
    const SUCCESS = 'success';

    static function log($message ,$type, $info = ''){
        $info = json_encode($info);
        $info = strval($info);
        $log = SystemLog::create([
            'type' => $type,
            'message' => $message,
            'info' =>  $info
        ]);
        $log -> save();
    }

    static function error($message, $info = ''){
        $info = json_encode($info);
        $info = strval($info);
        $log = SystemLog::create([
            'type' => self::ERROR,
            'message' =>  $message,
            'info' =>  $info
        ]);
        $log -> save();
    }
}