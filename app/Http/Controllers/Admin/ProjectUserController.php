<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectUser;

class ProjectUserController extends Controller
{
    

	public function store(Request $request){

		// El nivel pertenezca al proyecto
		// Asegurar que el proyecto exista
		// Asegurar que el nivel exista
		// Asegurar que el usuario exista

		// dd($request);

		$this->validate($request, 

		['project_id'			=> 'required',
		 'level_id'				=> 'required'],
		['project_id.required'	=> 'Es necesario seleccionar un proyecto.',
		 'level_id.required'	=> 'Es necesario seleccionar un nivel.']);


		$project_id = $request->input('project_id');
		$user_id 	= $request->input('user_id');


		$project_user = ProjectUser::where("project_id",$project_id)
										->where("user_id",$user_id)->first();

		if($project_user)
			return back()->with("notification","El usuario ya pertenece a este proyecto");								

		$project_user = new ProjectUser();
		$project_user->project_id = $project_id;
		$project_user->user_id 	  = $user_id;
		$project_user->level_id   = $request->input('level_id');
		$project_user->save();

		return back()->with("notification","El usuario ha sido asignado al proyecto");	
	}


	    public function delete($id)
    {
    	ProjectUser::find($id)->delete();
    	return back()->with("notification","El proyecto asignado al usuario ha sido eliminado");
    }



	public function update(Request $request) {

		// select-project-modal
		// select-level-modal
		// project_user_modal

		$this->validate($request, 

		['select-level-modal'	=> 'required'],
		['select-level-modal.required'	 => 'Es necesario seleccionar un nivel.']);


		$project_user_modal   = $request->input('project_user_modal');
		$select_project_modal = $request->input('select-project-modal');
		$select_level_modal   = $request->input('select-level-modal');
		$user_id 			  = $request->input('user_id');

		/*
		$project_user = ProjectUser::where("project_id",$select_project_modal)
										->where("user_id",$user_id)->first();

		if($project_user)
			return back()->with("notification","El usuario ya pertenece a este proyecto");								
		*/

		$project_user 			  = ProjectUser::find($project_user_modal);

     /* Solo cambio de nivel dentro de un mismo proyecto se podra
	 	$project_user->project_id = $select_project_modal;  */
		$project_user->user_id 	  = $user_id;
		$project_user->level_id   = $select_level_modal;
		$project_user->save();

		return back()->with("notification","El usuario ha sido asignado a otro nivel en el proyecto");

	}


}
