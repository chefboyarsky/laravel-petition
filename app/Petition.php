<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $fillable = ['title', 'summary', 'body'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
