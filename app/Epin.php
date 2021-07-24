<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epin extends Model
{
    protected $guarded = ['id'];

    public function pin_user(){
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }


}
