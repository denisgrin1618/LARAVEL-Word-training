<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use App\Language;
use App\Translation;
use App\TranslationStatistics;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $appends = [
        'total_words', 
        "total_correct_answers", 
        "total_wrong_answers",
        "success_rate",
        "total_favorites",
        "total_time_spent"
    ];
    
//    protected $attributes = [
//        'total_words' => '',
//    ];
    
    
    public function translates(){
        return $this->hasMany('App\Translate');
    }
    
    public function getTotalWordsAttribute(){
        return Translation::where('user_id', $this->id)->count();
    }
    
    public function getTotalCorrectAnswersAttribute() {
        
        return DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                //->join('words', 'translations.word2_id', '=', 'words.id')
                ->join("words", function($join) {
                    $join->on('translations.word2_id', '=', 'words.id')
                    ->on('quiz_history.answer', '=', 'words.name');
                })
                ->where('translations.user_id', '=', $this->id)
                ->count();

    }
    
    public function getTotalWrongAnswersAttribute() {
        
        return DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                ->join("words", function($join) {
                    $join->on('translations.word2_id', '=', 'words.id')
                         ->on('quiz_history.answer', '!=', 'words.name');
                })
                ->where('translations.user_id', '=', $this->id)
                ->count();

    }
    
    public function getSuccessRateAttribute() {
        
        $all_words = DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                ->where('translations.user_id', '=', $this->id)
                ->count();
        
        $correct_answers = DB::table('quiz_history')
                ->join('translations', 'quiz_history.translation_id', '=', 'translations.id')
                ->join("words", function($join) {
                    $join->on('translations.word2_id', '=', 'words.id')
                    ->on('quiz_history.answer', '=', 'words.name');
                })
                ->where('translations.user_id', '=', $this->id)
                ->count();

        return $all_words == 0 ? 0 : round($correct_answers * 100 / $all_words, 0);
    }
   
    public function getTotalFavoritesAttribute() {
        
        return DB::table('translations')
                ->join('translation_statistics', 'translations.id', '=', 'translation_statistics.translation_id')
                ->where('translations.user_id', $this->id)
                ->where('translation_statistics.favorite', true)
                ->count();

    }
    
    public function getTotalTimeSpentAttribute(){
        
//        $total_seconds = Quiz::where('user_id', $this->id)
//                ->groupBy('user_id')
//                ->selectRaw('sum(time_in_seconds) as total_spended_time')
//                ->first()
//                ->total_spended_time;
        
        $quiz = Quiz::where('user_id', $this->id)
                ->groupBy('user_id')
                ->selectRaw('sum(time_in_seconds) as total_spended_time')
                ->first();

        $total_seconds =  is_null($quiz) ? 0 : $quiz->total_spended_time;
        
        
        $minutes = round($total_seconds / 60);
        $seconds = $total_seconds % 60;
        $hours   = round($minutes/60);
        

//        $minutes = $minutes < 10 ? "0" + $minutes : $minutes;
//        $seconds = $seconds < 10 ? "0" + $seconds : $seconds;

        return "".$hours."h ".$minutes."m ".$seconds."s";

                
    }
}
