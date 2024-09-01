<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable=['title','description','start_date','end_date','thumb','lonCountry','latCountry','latCity','lonCity','country','city'];

    public function stops(){
        return $this->hasMany(Stop::class,'id_trip');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class,'trip_id');
    }
}
