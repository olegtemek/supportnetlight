@extends('layouts.main')

@section('title','Доступы')



@section('content')
<div class="row">
    @if (session('message'))
      <div class="alert alert-success col-12">
          {{ session('message') }}
      </div>
  @endif
  <div class="col-6">
    <a href="{{ route('access.create') }}" class="btn btn-success">Добавить запись</a>
    <a href="{{ route('access.deleted') }}" class="btn btn-warning">Удаленные записи</a>
  </div>
  <div class="col-12 mt-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Таблица с сайтами на тех-поддержке</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" id="accessSearch" class="form-control float-right" placeholder="Поиск..">
              
          </div>
        </div>
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
          <tbody class="access-table">
            @foreach ($accesses as $access)
              <tr>
                <td>{{ $access->id }}</td>
                <td>{{ $access->title }}</td>
                <td><a href="{{ $access->link }}">{{ $access->link }}</a></td>
                <td>{{ $access->login }}</td>
                <td>{{ $access->pass }}</td>
                <td>{{ $access->description ?? '-'}}</td>
                <td>
                  <a class="btn btn-success" href="{{ route('access.edit',$access->id) }}"><i class="fas fa-pen"></i></a>
                  <form style="display: inline" action="{{ route('access.destroy', $access->id) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger btn-delete"><i class="far fa-trash-alt"></i></button>
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
  $('#accessSearch').on('keyup', function(){
      $value = $(this).val();
      
      $.ajax({
        type:'get',
        url:"{{ route('access.search') }}",
        data:{'search':$value},

        success:function(data){
          
          $('.access-table').html(data)

        },
      })
  });



  

// $.ajax({
//   url:'https://support.netlight.kz/sup.php',
//   method:'POST',
//   dataType:'json',
//   complete:function(data){
//     if(data.responseText == 1){
//       console.log('good')
//     }else{
//       console.log('notgood')
//     }
//   },
// })
  
  </script>

@endsection