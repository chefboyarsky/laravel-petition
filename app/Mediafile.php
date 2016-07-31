<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mediafile extends Model
{
    protected $guarded = ['filename','mime','original_filename'];

    public function petition()
    {
        return $this->belongsTo('App\Petition', 'petition_id');
    }    
}
