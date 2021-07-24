<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = ['id'];

    public function plan_level(){
        return $this->hasMany(MatrixLevel::class,'plan_id','id');
    }
}
