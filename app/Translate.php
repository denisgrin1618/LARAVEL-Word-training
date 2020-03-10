<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
     public function show()
    {
        return view('translate');
    }
}
