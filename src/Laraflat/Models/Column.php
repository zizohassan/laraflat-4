<?php

namespace Laraflat\Laraflat\Laraflat\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{

    protected $fillable = [
        'name' , 'modifiers' , 'column' ,'module_id','multi_lang'
    ];

    /**
     * Set the column name.
     *
     * @param  string  $value
     * @return void
     */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = snake_case(trim($value));
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function details(){
        return $this->hasOne(ColumnDetail::class);
    }

}
