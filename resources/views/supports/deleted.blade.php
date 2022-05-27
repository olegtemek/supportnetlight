@extends('layouts.main')

@section('title','Поддержка - завершенные записи')



@section('content')
<div class="row">
    @if (session('message'))
      <div class="alert alert-success col-12">
          {{ session('message') }}
      </div>
  @endif
  <div class="col-6">
    <a href="{{ route('support.index') }}" class="btn btn-info">Назад</a>
  </div>
  <div class="col-12 mt-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Таблица с завершенными сайтами по тех-поддержке</h3>
        
      </div>
    
      <div class="card-body table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed ">
          <thead>
            <tr>
              <th>id</th>
              <th>Название сайта</th>
              <th>Имя клиента</th>
              <th>Номер клиента</th>
              <th>Выполненные работы</th>
              <th>Поддержка до:</th>
              <th>Восстановить</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($supports as $support)
              <tr>
                <td>{{ $support->id }}</td>
                <td>{{ $support->title }}</td>
                <td>{{ $support->name }}</td>
                <td>{{ $support->number }}</td>
                <td style="word-wrap: break-word;max-width: 160px;">{{ $support->completed ?? '-' }}</td>
                <td>{{ $support->support_end }}</td>
                <td>
                  <form style="display: inline" action="{{ route('support.restore',$support->id) }}" method="POST">
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
