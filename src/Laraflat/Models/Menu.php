<?php

namespace Laraflat\Laraflat\Laraflat\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'name'
    ];

    public function items(){
        return $this->hasMany(MenuItem::class ,'menu_id');
    }

}
