<?php

namespace App\Http\Controllers;

use App\TranslationStatistics;
use App\Translation;
use Illuminate\Http\Request;

class StatisticsController extends Controller {

    
//    https://drivemarketing.ca/en/blog/connecting-laravel-to-a-google-sheet/
//    https://developers.google.com/sheets/api/quickstart/php
    
    public function store(Request $request) {

//        return $request->post('data');

        $data = $request->post('data');
        foreach (json_decode($data) as $data_row) {

            $translation = Translation::find($data_row->translation_id);
            $translation_statistics = TranslationStatistics::where('translation_id', $translation->id)->get();

            if ($translation_statistics->isEmpty()) {
                $translation_statistics = new TranslationStatistics;
                $translation_statistics->translation()->associate($translation);
                $translation_statistics->count_success = 0;
                $translation_statistics->count_error = 0;
                $translation_statistics->save();
            } else {
                $translation_statistics = $translation_statistics->first();
            }

            if ($data_row->correct_answer) {
                $translation_statistics->count_success++;
            } else {
                $translation_statistics->count_error++;
            }
            
            $translation_statistics->save();
        }
        
        return true;
    }

}
