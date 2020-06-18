<?php

namespace App\Http\Controllers;

//use App\Http\Requests\TranslateFormRequest;
use Illuminate\Http\Request;
use App\Language;
use App\Word;
use App\Translation;
use App\TranslationStatistics;
use App\ImportProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Jobs\ImportVacabularyFromGoogleTranslate;
use GoogleSheet;


class TranslationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show() {
        $languages = Language::all();

        $translates = Translation::where('user_id', Auth::user()->id)->paginate(25);

//        dd($translates);
        return view('translation.show')
                        ->with('languages', $languages)
                        ->with('translates', $translates)
                        ->with('search_input', ['language1' => 'en']);
    }

     
    public function add(Request $request) {

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



        $translate = Translation::where('word1_id', $word1->id)
                                ->where('word2_id', $word2->id)
                                ->get();
        if ($translate->isEmpty()) {
            $translate = new Translation;
            $translate->word1_id = $word1->id;
            $translate->word2_id = $word2->id;
            $translate->user()->associate($user);
            $translate->save();
        }

        return $translate->load('word1', 'word2', 'word1.language', 'word2.language')->toJson();
    }

    public function edit(Request $request) {


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
        
        
//        return $request->post('translate_id');
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
            $response = ['status' => 'error. could not delete translation id='.$id];
        }

        return response()->json($response);
    }

    public function search(Request $request) {


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
                ->when($language1, function ($query, $language1) use($word1) {

                    return $query->join('words as word1', 'translations.word1_id', '=', 'word1.id')
                            ->when($word1, function ($query, $word1) {
                                return $query->where('word1.name', 'like', '%' . $word1 . '%');
                            })
                            ->join('languages as language1', 'word1.language_id', '=', 'language1.id')
                            ->where('language1.name', $language1);
                })
                ->when($language2, function ($query, $language2) use($word2) {

                    return $query->join('words as word2', 'translations.word2_id', '=', 'word2.id')
                            ->when($word2, function ($query, $word2) {
                                return $query->where('word2.name', 'like', '%' . $word2 . '%');
                            })
                            ->join('languages as language2', 'word2.language_id', '=', 'language2.id')
                            ->where('language2.name', $language2);
                })
//                ->toSql();              
//                dd($translates);
                ->select('*', 'translations.id as id')
                ->paginate(config('app.paginate_max'))
                ->appends(request()->query());



        return view('translation.show')
                        ->with('languages', $languages)
                        ->with('translates', $translates)
                        ->with('search_input', $request->input());
    }

    public function import(Request $request, $spreadsheet_id=0) {
        
        if(empty($spreadsheet_id)){
            return view('translation.import');
        }else{
            
//            ImportVacabularyFromGoogleTranslate::dispatchNow($spreadsheet_id, Auth::user());
//            return response()->json('DONE');
          
            $data = GoogleSheet::importVocabulary($spreadsheet_id, Auth::user());
            return response()->json($data);
        }
        
    }
    

    
    public function importProgess() {
//        $import_progress = session('import_progress', 100); 
        
        $percent_progress = 0;
        
        $import_progress = ImportProgress::where('user_id', Auth::user()->id)->get();
        if (!$import_progress->isEmpty()) {
            $percent_progress = $import_progress->first()->percent_progress;
        }
        
        return response()->json($percent_progress);
    }


    public function importPost(Request $request) {
//        dd($request);

//        https://duplexcrux.wordpress.com/2015/04/18/laravel-5-google-apis-client-library/
//        https://laravel-news.com/google-api-socialite
//        
//        
//        Ajax
//        https://stackoverflow.com/questions/21530743/displaying-progress-while-waiting-for-controller-in-laravel-4
            
        $validatedData = $request->validate([
            'spreadsheetId' => ['required'],
        ]);
     
//        $user = Auth::user();
        
//        $import_progress = ImportProgress::where('user_id', $user->id)->get();
//        if ($import_progress->isEmpty()) {
//            $import_progress = new ImportProgress;
//            $import_progress->user()->associate($user);
//            
//        } else {
//            $import_progress = $import_progress->first();
//        }
//        $import_progress->percent_progress = 0;
//        $import_progress->save();
        
//        ImportVacabularyFromGoogleTranslate::dispatch($request->post('spreadsheetId'), $user);
        
//        ImportVacabularyFromGoogleTranslate::dispatchNow($request->post('spreadsheetId'), $user);
         
     
        $data = GoogleSheet::importVocabulary($request->post('spreadsheetId'), Auth::user());
        return response()->json($data);
              
    }

  

}
