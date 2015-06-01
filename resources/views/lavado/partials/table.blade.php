
              <table class="table table-hover" data-options="rownumbers:true">
                    <thead>
                      <tr>
                            <th>ID</th>
                            <th>Auxiliar</th>
                            <th>Patio</th>
                            <th>Proveedor</th>
                             <th>Fecha Inicio</th>
                             <th>Fecha Fin</th>
                               <th>Acciones</th>
                      </tr>
                    </thead>
                       <tbody>
                        @foreach ($ctls as $ctl)



                                @if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')
                                <tr  data-id="{{$ctl->usr_id}}">
                                    @else
                                 <tr class="danger" data-id="{{$ctl->usr_id}}">
                                 @endif
                                <td>{{$ctl->ctl_id}}</td>
                                <td>{{$ctl->usr_name}}</td>
                                <td>{{$ctl->pto_nombre}}</td>
                                <td>{{$ctl->pvd_nombre}}</td>
                                <td>{{$ctl->ctl_fecha_inicio}}</td>
                                @if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')
                                <td><i class="text-primary">Control Abierto</i></td>
                                @else
                                <td>{{$ctl->ctl_fecha_fin}}</td>
                                @endif


                                <td>

                                    <div class="fa-hover ">
                                        @if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')
                                    	<a href="../icon/user-plus">
                                        <i class="fa fa-plus fa-2x" title="Agregar Registro"></i></a>
                                        <a href="../icon/user-plus">
                                        <i class="fa fa-pencil fa-2x" title="Editar Control"></i></a>
                                        <a href="../icon/user-plus">
                                        <i class="fa fa-eye fa-2x" title="Ver Control"></i></a>
                                        <a href="../icon/user-plus">
                                        <i class="fa fa-trash-o fa-2x" title="Eliminar Control"></i></a>
                                    </div>
                                        @else
                                        <a href="../icon/user-plus">
                                    	<i class="fa fa-eye fa-2x" title="Ver Control"></i></a>

                                        @endif





                                </td>
                              </tr>
                            @endforeach
                      </tbody>
                </table>