<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function translations()
    {
        return $this->hasManyThrough('App\Translation', 'App\QuizTranslations', 'quiz_id',  'id', 'id', 'translate_id');
    }

}
