<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    
//    protected $primaryKey = 'id'; 
    
    public function word1()
    {
        return $this->hasOne('App\Word', 'id', 'word1_id');
    }
    
    public function word2()
    {
        return $this->hasOne('App\Word', 'id', 'word2_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function statistics()
    {
        return $this->hasOne('App\TranslationStatistics', 'translation_id', 'id');
    }
    
    public function scopeWithWord1Name($query, $name){
        return $query->whereHas(['word1' => function($q) use($name){
            $q->where('name','LIKE', '%$name%');
        }]);

        //        return $query->where('word1_id','>', $name);
    }
    

    
    
}
