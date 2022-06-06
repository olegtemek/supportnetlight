@extends('layouts.main')

@section('title','Статус сайта - добавить')

@section('content')
<div class="row">
  <div class="card card-warning col-sm-12">
    <div class="card-header">
      <h3 class="card-title">Добавить запись</h3>
    </div>

    <div class="card-body col-sm">
      <form method="POST" action="{{ route('status.store') }}">
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
        </div>
        <button class="btn btn-success" type="submit">Добавить запись</button>
      </form>
    </div>
    
    </div>
</div>
<!-- /.row -->
@endsection