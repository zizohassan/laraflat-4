<?php

namespace Laraflat\Laraflat\Laraflat\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    protected $fillable = [
        'name_en','name_ar','menu_id','parent_id','slug','order','icon','link'
    ];


    public function menu(){
        return $this->hasMany(Menu::class ,'menu_id');
    }


}
