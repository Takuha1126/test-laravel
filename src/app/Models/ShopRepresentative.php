<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ShopRepresentative extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'shop_representatives';

    protected $fillable = [
        'representative_name',
        'email',
        'password',
        'shop_id',
    ];

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }

}
