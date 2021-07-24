<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrixLevel extends Model
{
    protected $guarded = ['id'];

    public function plan_level(){
        return $this->belongsTo(Plan::class)->withDefault();
    }
}
