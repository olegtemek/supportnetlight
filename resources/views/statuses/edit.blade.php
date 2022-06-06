@extends('layouts.main')

@section('title','Статус сайта - редактировать')

@section('content')
<div class="row">
  <div class="card card-warning col-sm-12">
    <div class="card-header">
      <h3 class="card-title">Редактировать запись</h3>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('status.update',$status->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
             
              <label>Название сайта</label>
              @error('title')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ $status->title }}" class="form-control" name="title" placeholder="Название сайта">
            </div>
          </div>
         
          <div class="col-sm-6">
            <div class="form-group">
              <label>Ссылка</label>
              @error('link')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ $status->link }}" class="form-control" name="link" placeholder="Имя клиента">
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