<div class="panel panel-primary">
    <div class="panel-heading">Men&uacute;</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">     
        @if(auth()->check())
            <li @if(request()->is('home')) class="active" @endif ><a href="/home">Dashboard</a></li>
       {{-- <li @if(request()->is('ver')) class="active" @endif><a href="/ver">Ver incidencia</a></li> --}}
            <li @if(request()->is('reportar')) class="active" @endif><a href="/reportar">Reportar Incidencia</a></li>
           

        {{-- accessor y mutators --}} 

        @if(auth()->user()->is_admin) 

            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Administración <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li @if(request()->is('usuarios')) class="active" @endif ><a href="/usuarios">Usuarios</a></li>
                    <li @if(request()->is('proyectos')) class="active" @endif ><a href="/proyectos">Proyectos</a></li>
               {{-- <li @if(request()->is('config')) class="active" @endif><a href="/config">Configuración</a></li> --}}
                </ul>
            </li>

        @endif    

 
        @else
            <li @if(request()->is('')) class="active" @endif><a href="/">Bienvenidos</a></li>
            <li @if(request()->is('instrucciones')) class="active" @endif ><a target="_blank" href="/pdf/Manual_de_uso.pdf">Documentaci&oacute;n Sistema</a></li>
            <li><a href="javascript:void(0)" id="mostrarCredits" >Cr&eacute;ditos</a></li>
        @endif
        <ul>
    </div>
</div>

