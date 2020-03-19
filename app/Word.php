<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    // protected $table = 'words';
//    protected $primaryKey = 'id'; 
    
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    

}
