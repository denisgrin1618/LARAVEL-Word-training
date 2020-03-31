<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationStatistics extends Model
{
    
    protected $table = 'translation_statistics';
    
    public function translation()
    {
        return $this->belongsTo('App\Translation');
    }
    
   
    
}
