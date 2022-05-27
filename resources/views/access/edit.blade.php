@extends('layouts.main')

@section('title','Доступы - редактировать')

@section('content')
<div class="row">
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Редактировать запись</h3>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('access.update',$access->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
             
              <label>Название сайта</label>
              @error('title')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ $access->title }}" class="form-control" name="title" placeholder="Название сайта">
            </div>
          </div>
         
          <div class="col-sm-6">
            <div class="form-group">
              <label>Ссылка</label>
              @error('link')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ $access->link }}" class="form-control" name="link" placeholder="Имя клиента">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Логин</label>
              @error('login')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ $access->login }}" class="form-control" name="login" placeholder="Логин">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Пароль</label>
              @error('pass')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" class="form-control" value="{{ $access->pass }}" name="pass" placeholder="Пароль">
            </div>
          </div>
          <div class="col-sm-6">
          
            <div class="form-group">
              <label>Описание</label>
              <textarea class="form-control" rows="3"  name="description" placeholder="Описание">{{ $access->description ?? '' }}</textarea>
            </div>
          </div>  
        </div>
        <button class="btn btn-success" type="submit">Сохранить запись</button>
      </form>
    </div>
    
    </div>
</div>
<!-- /.row -->
@endsection