@extends('layout')

@section('content')

  <h2 class="text-center">Нов запис</h2>
  <br>
  <center>
  <a href="index" class="btn btn-primary">Виж всички записи</a>
  <br/><br/>
  </center>

    


  <form action = "insert" method = "post" class="form-group" style="width:70%; margin-left:15%;" enctype="multipart/form-data">
  @method('POST') 
  @csrf

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Грешки!</strong> Възникнаха следните грешки.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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


  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

  <label class="form-group">Име:</label>
    <input type="text" class="form-control" placeholder="Име" name="name"></br>
  <label>Email:</label>
    <input type="text" class="form-control" placeholder="Email" name="email"></br>
  <label>Пол:</label>
  
  <select class="form-control" name="gender">
    <option value="Мъж" >Мъж</option>
    <option value="Жена" >Жена</option>
  
  </select></br>
  <label>Снимка *:</label>
    <input type="file" name="image" placeholder="Снимка" class="form-control"></br>
    <button type="submit"  value = "Запиши" class="btn btn-primary">Запиши</button>
  </form>

@endsection 