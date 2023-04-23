<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'score';

     protected $fillable = [
        'team_id','event_id','classification_pointing_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function classification_pointing()
    {
        return $this->belongsTo(ClassificationPoint::class);
    }


}
