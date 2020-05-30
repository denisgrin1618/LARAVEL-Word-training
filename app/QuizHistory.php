<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    protected $table = 'quiz_history';
    
    public function translation()
    {
        return $this->belongsTo('App\Translation');
    }
    
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
    
    
    
}
