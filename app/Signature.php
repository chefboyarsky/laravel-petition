<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function petition()
    {
        return $this->belongsTo('App\Petition', 'petition_id');
    }
}
