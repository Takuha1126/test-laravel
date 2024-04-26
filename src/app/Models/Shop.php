<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'shop_name',
        'genre_id',
        'area_id',
        'description',
        'photo_url'
    ];

    public function area()
    {
    return $this->belongsTo('App\Models\Area', 'area_id');
    }

    public function genre()
    {
    return $this->belongsTo('App\Models\Genre', 'genre_id');
    }
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation', 'shop_id');
    }
}
