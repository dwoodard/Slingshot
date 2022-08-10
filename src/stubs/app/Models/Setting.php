<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;



    //Settings::config
    public static function config()
    {
        if(self::accessToDB()){
            return collect(
                self::all()->keyBy('name')->transform(function ($setting) {
                    return $setting->value;
                })->toArray()
            );
        }
    }

    private static function accessToDB()
    {
        try {
            \DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
