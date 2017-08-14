<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\ProjectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user                = auth()->user();
        $selected_project_id = $user->selected_project_id;


        if($user->is_support) {

            $my_incidents = Incident::where("project_id",$user->selected_project_id)
                                    ->where("support_id",$user->id)->get();

            $projectUser  = ProjectUser::where("project_id", $selected_project_id)
                                        ->where("user_id", $user->id)->first();      

           // dd($projectUser);                                                                   

            $pending_incidents = Incident::where("support_id",null)
                                        ->where("level_id", $projectUser->level_id)->get();   
        }


        $incidents_by_me = Incident::where("client_id", $user->id)
                                        ->where("project_id", $selected_project_id)->get();


        return view('home')->with(compact("my_incidents","pending_incidents","incidents_by_me"));

    }


        public function selectProject($id)
    {
        // Validar que el usuario esté asociado con el proyecto
        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }

}
