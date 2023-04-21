<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $table = 'classification';

    protected $fillable = [
        'name'
    ];

    public function classificationTransactions()
    {
        return $this->hasMany(ClassificationPoint::class, 'classification_id', 'id');
    }

    public static function search($search){
        return empty($search) ? static::query() :
        static::query()->where('name', 'like', '%'.$search.'%');
    }
}
