<?php

namespace App\Http\Controllers;
use App\Language;

use Illuminate\Http\Request;

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
        //dd($validatedData);


        //flash('Quiz started!')->success();

        return view('quiz.show');
    }
    
    public function start() {
        
        $languages = Language::all();
        
        return view('quiz.start')->with('languages', $languages);
    }

    public function show($id) {

        return view('quiz.show');
    }

}
