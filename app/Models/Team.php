<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';

    protected $fillable = [
        'name','photo'
    ];

    public static function search($search){
        return empty($search) ? static::query() :
        static::query()->where('name', 'like', '%'.$search.'%');
    }
}
