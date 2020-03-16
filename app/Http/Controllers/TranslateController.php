<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslateFormRequest;
use App\Language;
use App\Word;
use App\Translate;

class TranslateController extends Controller {

    public function show() {
        $languages = Language::all();
        $translates = Translate::all();
        
        return view('translate.show')
                ->with('languages', $languages)
                ->with('translates',$translates);
    }

    public function add(){
        $languages = Language::all();
        return view('translate.add') ->with('languages', $languages);
    }
    
    public function postAdd(TranslateFormRequest $request) {

        dd($request->post());
        $language1 = Language::where('name', $request->post('languageWord1'))->first();
        $word1 = Word::where('name', $request->post('word1'))
                ->where('language_id', $language1->id)
                ->get();

        if ($word1->isEmpty()) {
            $word1 = new Word;
            $word1->name = $request->post('word1');
            $word1->language()->associate($language1);
            $word1->save();
        }else{
            $word1 = $word1->first();
        }


        $language2 = Language::where('name', $request->post('languageWord2'))->first();
        $word2 = Word::where('name', $request->post('word2'))
                ->where('language_id', $language2->id)
                ->get();

        if ($word2->isEmpty()) {
            $word2 = new Word;
            $word2->name = $request->post('word2');
            $word2->language()->associate($language2);
            $word2->save();
        }else{
            $word2 = $word2->first();
        }

        

        $translate = Translate::where('word1_id', $word1->id)->where('word2_id', $word2->id)->get();
        if ($translate->isEmpty()) {
            $translate = new Translate;
            $translate->word1_id = $word1->id;
            $translate->word2_id = $word2->id;
            $translate->save();
        }


        //flash('translate created!')->success();
        //return redirect()->route('translate.show');
        
        $languages = Language::all();
        return view('translate.add')->with('languages', $languages);
    }

}
