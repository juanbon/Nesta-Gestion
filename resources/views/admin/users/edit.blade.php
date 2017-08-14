@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">

        @if (session('notification'))
            <div class="alert alert-success">
                {{session('notification')}}
            </div>        
        @endif

        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> 
                    @endforeach    
                </ul>
            </div>        
        @endif

       <form action="" method="POST">

        {{csrf_field()}}

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" readonly value="{{old('email',$user['email'])}}" class="form-control">
         </div>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{old('name',$user['name'])}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Contraseña <em>Ingresar solo si se desea modificar</em></label>
            <input type="text" name="password" value="{{old('password')}}" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary"> Guardar Usuario</button>
        </div>

       </form>

       <form action="/proyecto-usuario" method="POST">
        {{csrf_field()}}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" id="old_project" value="{{old('project_id')}}">
            <div class="row">
                <div class="col-md-4">
                    <select name="project_id" class="form-control" id="select-project">
                        <option value="">Seleccione proyecto</option>
                        @foreach ($project as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="level_id" class="form-control" id="select-level" disabled >
                    <option value="">Seleccione nivel</option>
                    </select>
                </div>
                <div class="col-md-4">
                <button class="btn btn-primary btn-block" >Asignar proyecto</button>
                </div>
            </div>
        </form>    

        <br>
        <p>Proyectos asignados</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Proyecto</th>
                        <th>Nivel</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                {{-- dd($projects_user->toarray()) --}}

                @foreach ($projects_user as $project_user)
                    <tr>
                        <td>{{ $project_user->project->name }}</td>
                        <td>{{ $project_user->level->name }}</td>
                        <td>
                            <button data-projectuser="{{ $project_user->id }}" data-project="{{ $project_user->project->id }}" data-level="{{ $project_user->level->id }}" class="btn btn-sm btn-primary" title="Editar">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button> {{-- Dar de baja para que el usuario no pertenezca mas al proyecto--}}
                            <a href="/proyecto-usuario/{{ $project_user->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja"> 
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr>
                 @endforeach   
                </tbody>
            </table>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modalEditProjectUser">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Editar asignacion de proyecto</h4>
         </div>
         <form action="/proyecto-usuario/editar" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <input type="hidden" name="project_user_modal" id="project_user_modal" value=""> 
               <div class="form-group ">
                <div class="col-md-5">
                    <select name="select-project-modal" class="form-control" id="select-project-modal">
                        <option value="">Seleccione proyecto</option>
                        @foreach ($project2 as $project3)
                            <option value="{{ $project3->id }}">{{ $project3->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="b1234"></div>
                <div class="col-md-6">
                    <select name="select-level-modal" class="form-control" id="select-level-modal" disabled >
                    <option value="">Seleccione nivel</option>
                    </select>
                </div>
                <div class="a1234" style="height:20px">&nbsp;</div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
@media (max-width: 992px) {
    
    .a1234 {
        height: 0px !important;   
    }

    .b1234 {
        height: 8px !important;   
    }

    .form-group {
    top: 6px;
    position: relative;
    margin-bottom: 14px;
    }
}
</style>

@endsection
@section("scripts")
    <script type="text/javascript" src="/js/admin/users/edit.js"></script>
@endsection
