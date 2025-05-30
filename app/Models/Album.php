<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id', 
        'name', 
        'sales', 
        'year', 
        'cover'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
