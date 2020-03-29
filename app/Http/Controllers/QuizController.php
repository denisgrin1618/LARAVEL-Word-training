<?php

namespace App\Http\Controllers;
use App\Language;
use App\Translate;
use App\Quiz;
use App\QuizTranslations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'word_language' => ['required', 'string', 'max:2', 'min:2'],
            'translate_language' => ['required', 'string', 'max:2', 'min:2'],
            'quantity_of_words' => ['required', 'integer'],
        ]);
        
        $string_time_now    = Carbon::now()->toDateTimeString();
        $user_id            = Auth::user()->id;
        $translates         = Translate::where('user_id', $user_id)
                                        ->take($request->post('quantity_of_words'))->get();
             
        $quiz = new Quiz;
        $quiz->name     = 'test '.$string_time_now;
        $quiz->user_id  = $user_id;
        $quiz->save();
        
        foreach ($translates as $translate ){
            $quizzes_translations = new QuizTranslations;
            $quizzes_translations->quiz_id      = $quiz->id;
            $quizzes_translations->translate_id = $translate->id;
            $quizzes_translations->save();
        }
      

//        dd($quiz->load('translations')->toJson(JSON_PRETTY_PRINT));
        
        $quiz->load('translations')->load('translations.word1')->load('translations.word2');
        return view('quiz.show')->with('quiz', $quiz);
    }
    
    public function start() {
        
        $languages = Language::all();
        
        return view('quiz.start')->with('languages', $languages);
    }

    public function show($id) {

        $quiz = Quiz::with('translations')
                ->with('translations.word1')
                ->with('translations.word2')
                ->where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
        
//        dd($quiz->toJson(JSON_PRETTY_PRINT));
        return view('quiz.show')->with('quiz', $quiz);
    }

}
