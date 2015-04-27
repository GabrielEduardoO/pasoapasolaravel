@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center"><h2>Usuarios</h2> </div>

        <div class="panel-body">
          <p>Hay {{$users->total()}} usuarios</p>
          
          <table class="table table-hover">
          <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->full_name}}</td>
        <td>{{$user->email}}</td>
        <td>
          <div class="radio">
                        <label><input type="radio" name="optradio">Option 2</label>
                </div>
        </td>
      </tr>
      @endforeach
      </tbody>
  </table>
  {!!$users->render()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
                
             