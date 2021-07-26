<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'stations',
        'image',
        'image_map',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function station()
    {
        return $this->hasOne(Station::class);
    }
}
