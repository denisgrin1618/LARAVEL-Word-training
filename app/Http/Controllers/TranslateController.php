<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslateFormRequest;
use App\Language;
use App\Word;
use App\Translate;
use Illuminate\Support\Facades\Auth;

class TranslateController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function show() {
        $languages = Language::all();
//        $translates = Translate::all();

        
        $translates = Translate::paginate(7);
        
        
            return view('translate.show')
                        ->with('languages', $languages)
                        ->with('translates', $translates);

    }

    public function add(TranslateFormRequest $request) {

        $language1 = Language::where('name', $request->post('word1_language_name'))->first();
        $word1 = Word::where('name', $request->post('word1_name'))
                ->where('language_id', $language1->id)
                ->get();

        if ($word1->isEmpty()) {
            $word1 = new Word;
            $word1->name = $request->post('word1_name');
            $word1->language()->associate($language1);
            $word1->save();
        } else {
            $word1 = $word1->first();
        }


        $language2 = Language::where('name', $request->post('word2_language_name'))->first();
        $word2 = Word::where('name', $request->post('word2_name'))
                ->where('language_id', $language2->id)
                ->get();

        if ($word2->isEmpty()) {
            $word2 = new Word;
            $word2->name = $request->post('word2_name');
            $word2->language()->associate($language2);
            $word2->save();
        } else {
            $word2 = $word2->first();
        }



        $translate = Translate::where('word1_id', $word1->id)->where('word2_id', $word2->id)->get();
        if ($translate->isEmpty()) {
            $translate = new Translate;
            $translate->word1_id = $word1->id;
            $translate->word2_id = $word2->id;
            $translate->save();
        }

        return $translate->load('word1','word2','word1.language','word2.language')->toJson();
        
//        return $request->post();
//        return $translate->fresh()->with('word1')->with('word2')->first()->toJson();       
//        return $translate->toJson();
//        return new JsonResponse($translate);
//        flash('translate created!')->success();
//        return redirect()->route('translate.show');
//        $languages = Language::all();
//        return view('translate.add')->with('languages', $languages);
    }

    public function edit(TranslateFormRequest $request) {


        try {

            $word1 = Word::findOrFail($request->post('translate_word1_id'));
            $word1->name = $request->post('translate_word1_name');
            $word1->save();

            $word2 = Word::findOrFail($request->post('translate_word2_id'));
            $word2->name = $request->post('translate_word2_name');
            $word2->save();

            $translate = Translate::findOrFail($request->post('translate_id'));
        } catch (Exception $e) {
            dd($e);
        }


        return $translate->toJson();
    }

    public function destroy($id){
        
        $resalt =false;
        $trabslate = Translate::find($id);
        if(is_null($trabslate)){
            $resalt = false;
        }else{
            $resalt = Translate::find($id)->delete();
        }
  
            
        if($resalt){
            $response = ['status' => 'success'];
        }else{
            $response = ['status' => 'error'];
        }
        
        return response()->json($response);
    }
    
}
