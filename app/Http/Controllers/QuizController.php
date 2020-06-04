<?php

namespace App\Http\Controllers;


use App\Language;
use App\Translation;
use App\Quiz;
use App\QuizTranslations;
use App\QuizHistory;
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


         $translates   = DB::table('translations')
                 ->join('words as word1', 'translations.word1_id', '=', 'word1.id')
                 ->join('languages as language1', 'word1.language_id', '=', 'language1.id')
                 ->join('words as word2', 'translations.word2_id', '=', 'word2.id')
                 ->join('languages as language2', 'word2.language_id', '=', 'language2.id')
                 ->where('translations.user_id', $user_id)
                 ->where('language1.name', $request->post('word_language'))
                 ->where('language2.name', $request->post('translate_language'))
                 ->select('translations.id')
                 ->inRandomOrder()
                 ->take($request->post('quantity_of_words'))
                 ->get();

       // dd($translates);



        $quiz = new Quiz;
        $quiz->name     = $string_time_now;
        $quiz->user_id  = $user_id;
        $quiz->save();

        foreach ($translates as $translate ){
            $quizzes_translations = new QuizTranslations;
            $quizzes_translations->quiz_id      = $quiz->id;
            $quizzes_translations->translate_id = $translate->id;
            $quizzes_translations->save();
        }


//        dd($quiz->load('translations')->toJson(JSON_PRETTY_PRINT));

//        $quiz->load('translations')->load('translations.word1')->load('translations.word2');

        return redirect()->route('quiz.id', ['id' => $quiz->id]);
//        return view('quiz.show')->with('quiz', $quiz);

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
    
    public function show_all() {

        $quizes = Quiz::with('translations')
                ->with('translations.word1')
                ->with('translations.word2')
                ->where('user_id', Auth::user()->id)
                ->paginate(config('app.paginate_max'));

        
//        dd($quiz->toJson(JSON_PRETTY_PRINT));

        return view('quiz.show_all')->with('quizes', $quizes);
    }

    public function destroy($id) {

        $resalt = false;
        $quiz = Quiz::find($id);
        if (is_null($quiz)) {
            $resalt = false;
        } else {
            $resalt = Quiz::find($id)->delete();
        }


        if ($resalt) {
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error. could not delete quiz id='.$id];
        }

        return response()->json($response);
    }
    
}
