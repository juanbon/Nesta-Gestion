<?php

namespace App\Http\Controllers;

use Request;
use Cookie;

class IndexController extends Controller
{
    
	
    public function index()
    {

        //  Cada un dia se ejecuta el seteo de cookie
        
    	if(Cookie::get("note")!=1){

    		Cookie::queue("note","1",1440); 
		
        }


        if(auth()->check()){

            return redirect('home');
        
        }else{

    	   return  view('auth.login');
        }

    }

}
