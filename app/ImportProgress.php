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
    
    public static function create_new($user, $percent_progress){
        
        $import_progress = self::where('user_id', $user->id)->get();
        if ($import_progress->isEmpty()) {
            $import_progress = new ImportProgress;
            $import_progress->user()->associate($user);
            $import_progress->percent_progress = $percent_progress;
            $import_progress->save();
        } else {
            $import_progress = $import_progress->first();
            $import_progress->percent_progress = $percent_progress;
            $import_progress->save();
        }

       return $import_progress;

    }
}
