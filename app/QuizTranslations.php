<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizTranslations extends Model
{
    
    protected $table = 'quiz_translations';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
   
    
}
