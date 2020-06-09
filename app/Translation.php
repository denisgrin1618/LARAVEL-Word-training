<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

//    protected $primaryKey = 'id'; 

    public function word1() {
        return $this->hasOne('App\Word', 'id', 'word1_id');
    }

    public function word2() {
        return $this->hasOne('App\Word', 'id', 'word2_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function statistics() {
        return $this->hasOne('App\TranslationStatistics', 'translation_id', 'id');
    }

    public function scopeWithWord1Name($query, $name) {
        return $query->whereHas(['word1' => function($q) use($name) {
                        $q->where('name', 'LIKE', '%$name%');
                    }]);

        //        return $query->where('word1_id','>', $name);
    }

    public static function get_translation($word1, $word2, $user) {

        $translate = self::where('word1_id', $word1->id)
                ->where('word2_id', $word2->id)
                ->where('user_id', $user->id)
                ->get();

        if ($translate->isEmpty()) {
            $translate = new Translation;
            $translate->word1_id = $word1->id;
            $translate->word2_id = $word2->id;
            $translate->user()->associate($user);
            $translate->save();
        } else {
            $translate = $translate->first();
        }

        return $translate;
    }

}
