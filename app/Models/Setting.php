<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function get($key)
    {
        $data = Setting::where(["name" => $key])->value('value');
        return $data;
    }
}
