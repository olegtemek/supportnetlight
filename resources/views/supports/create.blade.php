@extends('layouts.main')

@section('title','Поддержка - добавить')

@section('content')
<div class="row">
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Добавить запись</h3>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('support.store') }}">
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
              <label>Имя клиента</label>
              @error('name')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Имя клиента">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Номер клиента</label>
              @error('number')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ old('number') }}" class="form-control" name="number" placeholder="Номер клиента">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Поддержка до:</label>
              @error('support_end')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="hidden" name="support_end" value="{{ old('support_end') }}" id="supportHidden">
              <input name="date-range" type="text" class="form-control" value="{{ old('support_end') }}"  placeholder="Поддержка до:">
            </div>
          </div>
          <div class="col-sm-6">
          
            <div class="form-group">
              <label>Проведенные работы</label>
              <textarea class="form-control" rows="3"  name="completed" placeholder="Проведенные работы">{{ old('completed') }}</textarea>
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
