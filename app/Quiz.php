<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quiz extends Model {

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function translations() {
        return $this->hasManyThrough('App\Translation', 'App\QuizTranslations', 'quiz_id', 'id', 'id', 'translate_id');
    }
    
    

    public function history() {
        return $this->hasMany('App\QuizHistory');
    }

    public function pass_percentage() {
        $all_words = \DB::table('quiz_history')->where('quiz_id', '=', $this->id)->count();
        $correct_answers = \DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                //->join('words', 'translations.word2_id', '=', 'words.id')
                ->join("words", function($join) {
                    $join->on('translations.word2_id', '=', 'words.id')
                    ->on('quiz_history.answer', '=', 'words.name');
                })
                ->where('quiz_id', '=', $this->id)
                ->count();

        return $all_words == 0 ? 0 : round($correct_answers * 100 / $all_words, 0);
    }

    public function total_correct_answers() {
        $correct_answers = \DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                //->join('words', 'translations.word2_id', '=', 'words.id')
                ->join("words", function($join) {
                    $join->on('translations.word2_id', '=', 'words.id')
                    ->on('quiz_history.answer', '=', 'words.name');
                })
                ->where('quiz_id', '=', $this->id)
                ->count();

        return $correct_answers;
    }

    public function total_wrong_answers() {
        $wrong_answers = \DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                ->join("words", function($join) {
                    $join->on('translations.word2_id', '=', 'words.id')
                    ->on('quiz_history.answer', '!=', 'words.name');
                })
                ->where('quiz_id', '=', $this->id)
                ->count();

        return $wrong_answers;
    }

    public function scopeApplyFilters($query, $filters, $id) {
        // Perform filtering logic with $query->where(...);
        if ($filters != null && $filters['only_wrong_translations'] == "yes") {
//            
//            dd( $query
//                ->join('quiz_history', 'quiz_history.translation_id', '=', 'translation_id')           
//                
//                ->join("words",function($join){
//                        $join->on('translations.word2_id', '=', 'words.id')
//                             ->on('quiz_history.answer','!=','words.name');
//                })->toSql() );

            $translations_id = \DB::table('quiz_history')
                    ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                    ->join("words", function($join) {
                        $join->on('translations.word2_id', '=', 'words.id')
                        ->on('quiz_history.answer', '!=', 'words.name');
                    })
                    ->where('quiz_id', '=', $id)
                    ->pluck('translation_id')
                    ->toArray();


            //dd($translations_id);

            return $query->whereIn('quizzes.translation_id', $translations_id);
        } else {
            return $query;
        }
    }

}
