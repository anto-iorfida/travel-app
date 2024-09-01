<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\Stop;
class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'stop_id',
        'trip_id',
        'rating',
        'review',
    ];

    // Una valutazione può avere più viaggi
    public function trips()
    {
        return $this->hasMan(Trip::class);
    }
    
    public function stops()
    {
        return $this->hasMany(Stop::class);
    }
}
