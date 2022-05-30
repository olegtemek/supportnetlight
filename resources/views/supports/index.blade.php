@extends('layouts.main')

@section('title','Поддержка')



@section('content')


@if(!empty($supportsEnds))
<div class="card card-warning">
  <div class="card-header">
    <h3 class="card-title">Возможно закончилась или скоро закончится поддержка у этих сайтов</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  
  </div>
  
  <div class="card-body">
   @foreach ($supportsEnds as $end)
       <div>
         У сайта: <span class="text-bold">{{ $end->title }}</span> - До: <span class="text-bold">{{ $end->support_end }}</span>
        </div>
       
   @endforeach
  </div>
  
  </div>
@endif

<div class="row">
    @if (session('message'))
      <div class="alert alert-success col-12">
          {{ session('message') }}
      </div>
  @endif
  <div class="col-6">
    <a href="{{ route('support.create') }}" class="btn btn-success">Добавить запись</a>
    <a href="{{ route('support.deleted') }}" class="btn btn-warning">Завершенные записи</a>
  </div>
  <div class="col-12 mt-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Таблица с сайтами на тех-поддержке</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" id="supportSearch" class="form-control float-right" placeholder="Поиск">
          </div>
        </div>
      </div>
    
      <div class="card-body table-responsive p-0" style="">
        <table class="table table-head-fixed ">
          <thead>
            <tr>
              <th>id</th>
              <th>Название сайта</th>
              <th>Имя клиента</th>
              <th>Номер клиента</th>
              <th>Выполненные работы</th>
              <th id="filterDate">Поддержка до:</th>
              <th>Изменить/удалить</th>
            </tr>
          </thead>
          <tbody class="support-table">
            @foreach ($supports as $support)
              <tr>
                <td>{{ $support->id }}</td>
                <td>{{ $support->title }}</td>
                <td>{{ $support->name }}</td>
                <td>{{ $support->number }}</td>
                <td style="word-wrap: break-word;max-width: 160px;">{{ $support->completed ?? '-' }}</td>
                <td data-label="Дата" >{{ $support->support_end }}</td>
                <td>
                  <a class="btn btn-success" href="{{ route('support.edit',$support->id) }}"><i class="fas fa-pen"></i></a>
                  <form style="display: inline" action="{{ route('support.destroy', $support->id) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-info"><i class="fas fa-edit"></i></button>
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


@section('js')

<script>
  $('#supportSearch').on('keyup', function(){
      $value = $(this).val();
      
      $.ajax({
        type:'get',
        url:"{{ route('support.search') }}",
        data:{'search':$value},

        success:function(data){
          
          $('.support-table').html(data)

        },
      })
  });

  

  </script>



@endsection


