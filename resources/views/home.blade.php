@extends('layouts.main')

@section('title','Главная')


@section('content')
<div class="row">
  <div class="col-sm">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

      <div class="info-box-content">
        
        <span class="info-box-text">Кол-во доступов к сайтам : <span style="display: inline" class="info-box-number">{{ $accesses }}</span> </span>
        <a href="{{ route('access.export') }}" class="btn btn-success">Экспорт данных в Excel</a>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  

  <div class="col-sm mb-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Кол-во сайтов на тех поддержке : <span style="display: inline" class="info-box-number">{{ $supports }}</span> </span>
        
        <a href="{{ route('support.export') }}" class="btn btn-success">Экспорт данных в Excel</a>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="card-body table-responsive mt-4 p-0">
    <button class="btn btn-warning col-sm" id="add">Добавить заметку</button>
    <table class="table table-head-fixed ">
      
      <thead>
        <tr>
          <th style="width: 5%">Id</th>
          <th style="width: 80%">Описание</th>
          <th>Изменить/Удалить</th>
        </tr>
      </thead>
      <tbody class="support-table">
        @foreach ($notes as $note)
        <tr>
          <td>{{ $note->id }}</td>
          <td>{{ $note->description }}</td>
          <td>
            <button  class="btn edit btn-info" data-toggle="modal" data-target="#editModal{{ $note->id }}"><i class="fas fa-edit"></i></button>
            <form style="display: inline" action="{{ route('home.destroy',$note->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
            </form>
            <div class="modal fade" id="editModal{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $note->id }}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Изменить заметку</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="formEdit" action="{{ route('home.update',$note->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <textarea name="description" id="" style="width:100%" rows="10"></textarea>
                  </div>
                  <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('js')
 <script>
    $('#add').on('click',()=>{
        $.ajax({
        type:'post',
        url:"{{ route('home.store') }}",
        data:{"_token": "{{ csrf_token() }}",},
        success:function(data){
          location.reload();
        },
      })
    })
  </script>   
@endsection