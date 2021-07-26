<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'stations',
        'image',
        'image_map',
    ];
    /**
     * Get the user that owns the phone.
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
