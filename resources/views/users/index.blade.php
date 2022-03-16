@extends('layout')

@section('content')

<h2 class="text-center">Всички Записи</h2>
  <br>
  <center>
  <a href = "{{ route('users.insert') }}" class="btn btn-primary">Вмъкни Нов Запис</a>
</center>
  <br>     
  
  
  <form class="form-inline" method="GET">
  <div class="form-group mb-2">
    
    <input type="text" class="form-control" id="filter" name="filter" placeholder="Търси по Име..." value="{{$filter}}">
    &nbsp;<button type="submit" class="btn btn-primary">Търси</button>
  </div>
  
</form>

  
@if (session('status'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif


  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th width="5%">@sortablelink('id','ID')</th>
        <th width="35%">@sortablelink('name','Име')</th>
        <th width="35%">@sortablelink('email','Email')</th>
        <th width="5%">@sortablelink('gender','Пол')</th>
        <th width="10%">Снимка</th>
        <th width="5%">Edit</th>
        <th width="5%">Delete</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr @if($user->id == $_GET['uid'] ) style="background-color:#94e9a2;" @endif>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->gender }}</td>
      <td><img src="@if($user->image != ''){{asset('uploads')}}/{{$user->image}}@else {{asset('uploads')}}/noimage.jpg @endif" style="width:120px;" /></td>
      <td><a href = "{{ route('users.edit',$user->id) }}?page=@if($_GET['page']!=''){{ $_GET['page'] }}@endif" class="btn btn-primary">Edit</a></td>
      <td>
      {{--
      <a href = "{{ route('users.delete',$user->id) }}?page=@if($_GET['page']!=''){{ $_GET['page'] }}@endif" class="btn btn-danger">Delete</a>
      --}}

      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $user->id }}">
      Delete
</button>

<div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel{{ $user->id }}">Изтриване за запис</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Сигурни ли сте, че искате да изтриете записа
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
        <a href = "{{ route('users.delete',$user->id) }}?page=@if($_GET['page']!=''){{ $_GET['page'] }}@endif" class="btn btn-danger">Изтрии</a>
        
      </div>
    </div>
  </div>
</div>


      
    
    </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{--
  {{ $users->links() }}
  --}}
  {{ $users->appends(Request::except('page'))->render() }}
  @endsection 