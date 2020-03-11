<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslateFormRequest;
use App\Language;
use App\Word;

class TranslateController extends Controller
{
    public function show()
    {
        return view('translate');
    }
    
    public function add(TranslateFormRequest $request)
    {
         
        //dd($request->input('word1'));
        $language = Language::Find(1);
        $word = new Word;
        $word->name = $request->input('word1');
        $word->language()->associate($language);
        $word->save();
         
         
        //flash('translate created!')->success();
        return redirect()->route('translate.show');
    }
}
