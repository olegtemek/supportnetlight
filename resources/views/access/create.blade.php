@extends('layouts.main')

@section('title','Доступы - добавить')

@section('content')
<div class="row">
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Добавить запись</h3>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('access.store') }}">
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
             
              <label>Название сайта</label>
              @error('title')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ old('title') }}" class="form-control" name="title" placeholder="Название сайта">
            </div>
          </div>
         
          <div class="col-sm-6">
            <div class="form-group">
              <label>Ссылка</label>
              @error('link')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ old('link') }}" class="form-control" name="link" placeholder="Ссылка">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Логин</label>
              @error('login')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ old('login') }}" class="form-control" name="login" placeholder="Логин">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Пароль</label>
              @error('pass')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" class="form-control" value="{{ old('pass') }}" name="pass" placeholder="Пароль">
            </div>
          </div>
          <div class="col-sm-6">
          
            <div class="form-group">
              <label>Описание</label>
              <textarea class="form-control" rows="3"  name="description" placeholder="Описание">{{ old('description') }}</textarea>
            </div>
          </div>  
        </div>
        <button class="btn btn-success" type="submit">Добавить запись</button>
      </form>
    </div>
    
    </div>
</div>
<!-- /.row -->
@endsection