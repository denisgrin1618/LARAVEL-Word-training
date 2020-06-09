<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ISOLanguage;

class Language extends Model
{
    //protected $table = 'languages';
    
    public static function get_language($name){
        
        if(empty($name)){
            return null;
        }
        
        
        $iso = ISOLanguage::where('name', $name)->first();
        if(empty($iso)){
            return null;
        }
        
        
        $language = self::where('name', $iso->iso)->get();
        
        if($language->isEmpty()){
            $language = new Language;
            $language->name = $iso->iso;
            $language->save();
        }else{
            $language = $language->first();
        }
        
        return $language;
  
    }
}
