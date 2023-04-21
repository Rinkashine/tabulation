<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationPoint extends Model
{
    use HasFactory;

    protected $table = 'classification_pointing';
    protected $fillable = [
        'classification_id','position','score'
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

}
