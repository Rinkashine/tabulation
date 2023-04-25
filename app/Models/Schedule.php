<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = [
        'name','photo'
    ];

    public static function search($search){
        return empty($search) ? static::query() :
        static::query()->where('name', 'like', '%'.$search.'%');
    }
}
