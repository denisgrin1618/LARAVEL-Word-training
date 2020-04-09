<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportProgress extends Model
{
    protected $table = 'import_progress';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
