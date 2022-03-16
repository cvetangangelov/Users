@extends('layout')


@section('content')
  <h2 class="text-center">Промяна на запис</h2>
  <br>
  <center>
  <a href="{{ route('users.viewall',$users->id) }}?page={{ $_GET['page'] }}" class="btn btn-primary">Виж всички записи</a>
  <br/><br/>
  </center>

 
  <form action = "?page={{ $_GET['page'] }}" method = "post" class="form-group" style="width:70%; margin-left:15%;" enctype="multipart/form-data">
   @method('POST') 
   @csrf
   <input type="hidden" name="f" value="edit">
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

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
  <label class="form-group">Име:</label>
    <input type="text" class="form-control" placeholder="Име" name="name" value = "{{ $users->name }}"></br>
  <label>Email:</label>
    <input type="text" class="form-control" placeholder="Email" name="email" value = "{{ $users->email }}"></br>
  <label>Пол:</label>
  
  <select class="form-control" name="gender">
    <option value="Мъж" >Мъж</option>
    <option value="Жена" >Жена</option>
  
  </select></br>
  <label>Снимка *:</label>
    <input type="file" name="image" class="form-control"></br>
@if ($users->image != '')
    <img src="{{asset('uploads')}}/{{ $users->image }}" style="width:120px;" /> <a href = "{{ route('users.edit.deleteimage',$users->id) }}?page= {{ $_GET['page'] }}" class="btn btn-primary">Изтрии снимката</a>
@else 
    <img src="{{asset('uploads')}}/noimage.jpg" style="width:120px;" />
@endif
</br></br>
    <input type="submit" name="submit"  value = "Запиши" class="btn btn-primary">
  </form>
  
@endsection 