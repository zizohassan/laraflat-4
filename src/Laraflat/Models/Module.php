<?php

namespace Laraflat\Laraflat\Laraflat\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    protected $fillable = [
        'name' , 'admin' , 'website' , 'api'
    ];

    /**
     * Set the module name.
     *
     * @param  string  $value
     * @return void
     */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(Illuminate\Support\Str::camel(str_plural(trim($value))));
    }


    public function columns(){
        return $this->hasMany(Column::class);
    }

    public function details(){
        return $this->hasMany(ColumnDetail::class);
    }

}
