<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'text', 'id_stop'
    ];

    // Relazione con il modello Stop
    public function stop()
    {
        return $this->belongsTo(Stop::class, 'id_stop');
    }
}