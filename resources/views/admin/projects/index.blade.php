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
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control">
         </div>

        <div class="form-group">
            <label for="description">Descripci&oacute;n</label>
            <input type="text" name="description" value="{{old('description')}}" class="form-control">
         </div>

        <div class="form-group">
            <label for="date">Fecha de inicio</label>
            <input type="date" name="start" value="{{old('date',date('Y-m-d'))}}" class="form-control">
         </div>

        <div class="form-group">
            <button class="btn btn-primary"> Registrar Proyecto</button>
        </div>

       </form>

        <p>Proyectos asignados</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripci&oacute;n</th>
                    <th>Fecha de inicio</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start?:"No asignado" }}</td>
                    <td>

                        @if ($project->trashed())
                            <a href="/proyecto/{{ $project->id}}/restaurar" class="btn btn-sm btn-success" title="Restaurar">
                            <span class="glyphicon glyphicon-repeat"></span>
                            </a>
                        @else
                            <a href="/proyecto/{{ $project->id }}" class="btn btn-sm btn-primary" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="/proyecto/{{ $project->id}}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                            <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
