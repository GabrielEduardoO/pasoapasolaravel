
 <div class="form-control-wrapper col-md-1 col-md-offset-0">
                                                      <a href="{{route('registro.show', $id)}}">
                                                      <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a>
                                           </div>

                                        <div class="form-group-danger ">
                                        	<div class="form-control-wrapper col-md-3 col-md-offset-1">
                                        		<input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}">
                                        		<div class="floating-label">Usuario:</div>
                                        		<span class="material-input"></span>
                                        	</div>
                                        </div>




                                        <div class="form-group-danger ">
                                            <div class="form-control-wrapper col-md-3 col-md-offset-0">
                                                <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pto_nombre->pto_nombre}}">
                                                <div class="floating-label">Terminal:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>

                                        <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-2 col-md-offset-0">
                                                    <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pvd_nombre->pvd_nombre}}">
                                                    <div class="floating-label">Proveedor:</div>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>

                                        <div class="form-group-danger">
                                            <div class="form-control-wrapper col-md-2 col-md-offset-0">
                                                <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value=" <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>">
                                                <div class="floating-label">Fecha de inicio:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div><br><br><br>









  {!! Form::model(Request::all(),['route' => 'lavado.update', 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}

                            @include('lavado.partials.list')
                            {!!Form::close()!!}



