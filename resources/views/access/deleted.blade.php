@extends('layouts.main')

@section('title','Доступы - удаленные записи')



@section('content')
<div class="row">
    @if (session('message'))
      <div class="alert alert-success col-12">
          {{ session('message') }}
      </div>
  @endif
  <div class="col-6">
    <a href="{{ route('access.index') }}" class="btn btn-info">Назад</a>
  </div>
  <div class="col-12 mt-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Таблица с удаленными доступами</h3>
        
      </div>
    
      <div class="card-body table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed ">
          <thead>
            <tr>
              <th>id</th>
              <th>Название сайта</th>
              <th>Ссылка</th>
              <th>Логин</th>
              <th>Пароль</th>
              <th>Описание</th>
              <th>Изменить/удалить</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($accesses as $access)
            <tr>
              <td>{{ $access->id }}</td>
              <td>{{ $access->title }}</td>
              <td><a href="{{ $access->link }}">{{ $access->link }}</a></td>
              <td>{{ $access->login }}</td>
              <td>{{ $access->pass }}</td>
              <td>{{ $access->description }}</td>
              <td>
                <form style="display: inline" action="{{ route('access.restore',$access->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-success"><i class="fa fa-sync-alt"></i></button>
                  </form>
              </td>
          
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    
    </div>
    
    </div>
</div>
<!-- /.row -->
@endsection
