
              <table class="table table-hover" data-options="rownumbers:true">
                    <thead>
                      <tr>
                            <th>AN8</th>
                            <th>Nombre</th>
                            <th>Email</th>
                             <th>Usuario</th>
                             <th>Identificación</th>
                               <th>Acciones</th>
                      </tr>
                    </thead>
                       <tbody>
                            @foreach ($users as $user)
                            @if($user->usr_emp_an8 != "")
                            <tr  data-id="{{$user->usr_id}}">
                                @else
                             <tr class="active" data-id="{{$user->usr_id}}">
                             @endif

                                <td>{{$user->usr_id}}</td>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->emp_correo}}</td>
                                 @if($user->usr_emp_an8 != "")
                                 <td>{{$user->usr_name}}</td>
                                @else
                                <td></td>
                                 @endif

                                <td>{{$user->emp_identificacion}}</td>
                                 @if($user->usr_emp_an8 != "")
                                <td><a class="text-info" href="{{route('admin.users.edit', $user)}}">Ver Empleado</a></td>
                                 @else
                                 <td><a class="text-primary" href="{{route('admin.users.edit',$user)}}">Crear Usuario</a></td>
                                @endif

                              </tr>
                            @endforeach
                      </tbody>
                </table>