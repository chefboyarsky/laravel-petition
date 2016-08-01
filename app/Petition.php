<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $fillable = ['title', 'summary', 'body', 'thanks_message', 'thanks_email', 'thanks_sms'];

    protected $guarded = ['published'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function mediafiles()
    {
        return $this->hasMany('App\Mediafile', 'petition_id');
    }

    public function signatures()
    {
        return $this->hasMany('App\Signature', 'petition_id');
    }
}
