<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicketComment extends Model
{
    protected $guarded = ['id'];

    public function userComment()
    {
        return $this->where('type', 0);
    }

    public function adminComment()
    {
        return $this->where('type', 1);
    }
}
