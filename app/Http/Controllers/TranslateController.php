<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslateFormRequest;
use App\Language;
use App\Word;
use App\Translation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TranslateController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show() {
        $languages = Language::all();

        $translates = Translation::where('user_id', Auth::user()->id)->paginate(7);

        return view('translate.show')
                        ->with('languages', $languages)
                        ->with('translates', $translates)
                        ->with('search_input', []);
    }

    public function add(TranslateFormRequest $request) {

        $user = Auth::user();
        $language1 = Language::where('name', $request->post('word1_language_name'))->first();
        $word1 = Word::where('name', $request->post('word1_name'))
                ->where('language_id', $language1->id)
                ->where('user_id', $user->id)
                ->get();

        if ($word1->isEmpty()) {
            $word1 = new Word;
            $word1->name = $request->post('word1_name');
            $word1->language()->associate($language1);
            $word1->user()->associate($user);
            $word1->save();
        } else {
            $word1 = $word1->first();
        }


        $language2 = Language::where('name', $request->post('word2_language_name'))->first();
        $word2 = Word::where('name', $request->post('word2_name'))
                ->where('language_id', $language2->id)
                ->where('user_id', $user->id)
                ->get();

        if ($word2->isEmpty()) {
            $word2 = new Word;
            $word2->name = $request->post('word2_name');
            $word2->language()->associate($language2);
            $word2->user()->associate($user);
            $word2->save();
        } else {
            $word2 = $word2->first();
        }



        $translate = Translation::where('word1_id', $word1->id)->where('word2_id', $word2->id)->get();
        if ($translate->isEmpty()) {
            $translate = new Translation;
            $translate->word1_id = $word1->id;
            $translate->word2_id = $word2->id;
            $translate->user()->associate($user);
            $translate->save();
        }

        return $translate->load('word1', 'word2', 'word1.language', 'word2.language')->toJson();

    }

    public function edit(TranslateFormRequest $request) {


        try {

            $word1 = Word::findOrFail($request->post('translate_word1_id'));
            $word1->name = $request->post('translate_word1_name');
            $word1->save();

            $word2 = Word::findOrFail($request->post('translate_word2_id'));
            $word2->name = $request->post('translate_word2_name');
            $word2->save();

            $translate = Translation::findOrFail($request->post('translate_id'));
        } catch (Exception $e) {
            dd($e);
        }


        return $translate->toJson();
    }

    public function destroy($id) {

        $resalt = false;
        $trabslate = Translation::find($id);
        if (is_null($trabslate)) {
            $resalt = false;
        } else {
            $resalt = Translation::find($id)->delete();
        }


        if ($resalt) {
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error'];
        }

        return response()->json($response);
    }

    public function search(TranslateFormRequest $request) {

        
        $word1 = $request->word1;
        $word2 = $request->word2;
        $language1 = $request->language1;
        $language2 = $request->language2;
        $user_is = Auth::user()->id;

        $languages = Language::all();


        $translates = Translation::
                join('users', function($join) use ($user_is) {
                    $join->on('translations.user_id', '=', 'users.id')->where('users.id', $user_is);
                })
                ->when($language1, function ($query, $language1) use($word1){

                    return $query->join('words as word1', 'translations.word1_id', '=', 'word1.id')
                            
                            ->when($word1, function ($query, $word1){
                                return $query->where('word1.name', 'like', '%' . $word1 . '%');
                            })
                            ->join('languages as language1', 'word1.language_id', '=', 'language1.id')
                            ->where('language1.name', $language1);
                })   
                ->when($language2, function ($query, $language2) use($word2){

                    return $query->join('words as word2', 'translations.word2_id', '=', 'word2.id')
                            
                            ->when($word2, function ($query, $word2){
                                return $query->where('word2.name', 'like', '%' . $word2 . '%');
                            })
                            ->join('languages as language2', 'word2.language_id', '=', 'language2.id')
                            ->where('language2.name', $language2);
                })   
                ->paginate(7)
                ->appends(request()->query());
        


        return view('translate.show')
                        ->with('languages', $languages)
                        ->with('translates', $translates)
                        ->with('search_input', $request->input());
    }

}
