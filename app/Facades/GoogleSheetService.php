<?php

namespace App\Facades;
 
use Illuminate\Support\Facades\Facade;


class GoogleSheetService extends Facade{
  
    
    protected static function getFacadeAccessor() {
        return 'googleSheet';
    }
}
