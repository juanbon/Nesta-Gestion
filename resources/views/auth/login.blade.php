@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection



<div style="display:none" class="modal fade" tabindex="-1" role="dialog" id="creditsModal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Tecnologias Aplicadas</h4>
         </div>

            <div class="modal-body" style="padding:5px !important">
            <input type="hidden" name="level_id" id="level_id" value="">
            <div class="form-group" style="text-align:center !important;">
                    <div style="display: inline-block !important;">
                        
                        <div class="boxy">
                        <img title="Mysql" style="width:100px;height:80px" src="images/mysql.png"></div><div style="position:relative;left:40px !important" class="boxy">
                        <img title="Laravel 5.4" style="width:70px;height:70px" src="images/laravel.png"></div>
                        
                        
                        
                        <div class="boxy_sp">&nbsp;</div><div class="boxy_sp">&nbsp;</div>
                        
                        <div class="boxy"><img title="PHP" style="width:100px;height:100px" src="images/php.png"></div>
                        <div class="boxy_sp">&nbsp;</div>
                        
                        <div class="boxy">
                        <img title="Jquery/Ajax" style="width:70px;height:70px" src="images/js.png"></div>

                        <div style="clear:both;height:25px"></div>

                        <div class="boxy"></div>
                        <div class="boxy">
                        <img title="Jquery" style="top:-15px;width:100px;height:100px;position:relative" src="http://www.ics.hawaii.edu/wp-content/uploads/2013/08/jquerylogo320.png"></div>
                        <div style="top:-13px;position:relative;left:40px !important" class="boxy">
                        <img title="Bootstrap" style="width:100px;height:100px" src="images/bostp.png"></div>
                        
                        <div class="boxy_sp">&nbsp;</div><div class="boxy_sp">&nbsp;</div>                        
                        <div class="boxy_sp">&nbsp;</div>
                        
                        <div class="boxy"></div>
                    </div>
                </div>
            </div>
            <style> 
            .boxy{     
                float: left;
                width: 75px;
                height: 70px;
                padding: 5px;
                }
            .boxy_sp{
                width: 30px;
                float: left;
                }   
            </style>
            <div style="text-align:center;font-size: 14px;" class="modal-footer">-Desarrollado por Juan Bonifacio-
            </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    

<div  style="display:none" class="modal fade" tabindex="-1" role="dialog" id="modalNote">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Informacion</h4>
         </div>
         <form action="/nivel/editar" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <input type="hidden" name="level_id" id="level_id" value="">
               <div class="form-group">
                  Nesta Gesti&oacute;n es un sistema web, desarrollado en PHP (Laravel 5.4)<br>Esta presentaci&oacute;n es un DEMO, de un proyecto de practica personal, y esta en desarrollo. Los datos ingresados en el sistema son de prueba.
               </div>
            </div>
            <div class="modal-footer">
            </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@if(!Cookie::get("note"))
<script>
setTimeout(function(){ 
    (function () {
        $("#modalNote").modal("show");
    }()); 
 }, 1000);
</script>
@endif  
