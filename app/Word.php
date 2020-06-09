<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model {

    // protected $table = 'words';
//    protected $primaryKey = 'id'; 

    public function language() {
        return $this->belongsTo('App\Language');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function get_word($user, $language, $name) {

        $word = self::where('name', $name)
                ->where('language_id', $language->id)
                ->where('user_id', $user->id)
                ->get();

        if ($word->isEmpty()) {
            $word = new Word;
            $word->name = $name;
            $word->language()->associate($language);
            $word->user()->associate($user);
            $word->save();
        } else {
            $word = $word->first();
        }

        return $word;
    }

}
