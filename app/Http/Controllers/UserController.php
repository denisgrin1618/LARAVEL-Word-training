<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;

class UserController extends Controller
{
    public function profile(){
    	return view('user.profile', array('user' => Auth::user()) );
    }
    
    public function update_avatar(Request $request){

        $user = Auth::user();
        
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/img/avatars/' . $filename ) );

    		
    		$user->avatar = $filename;
    		
    	}

        if(!is_null($request->post('name')) && $request->post('name') != $user->name){
            $user->name = $request->post('name');
        }
        
        if(!is_null($request->post('email')) && $request->post('email') != $user->email){
            $user->email = $request->post('email');
        }
        
        $user->save();
        
    	return view('user.profile', array('user' => Auth::user()) );

    }
}
