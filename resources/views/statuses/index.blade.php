@extends('layouts.main')

@section('title','Статусы сайтов')



@section('content')
<div class="row">
    @if (session('message'))
      <div class="alert alert-success col-12">
          {{ session('message') }}
      </div>
  @endif
  <div class="col-6">
    <a href="{{ route('status.create') }}" class="btn btn-success">Добавить запись</a>
    
  </div>
  <div class="col-12 mt-4">
    <div class="card">
    
      <div class="card-body table-responsive p-0" >
        <table class="table table-head-fixed ">
          <thead>
            <tr>
              <th>id</th>
              <th>Название сайта</th>
              <th>Ссылка</th>
              <th>Статус</th>
              <th>Изменить/удалить</th>
            </tr>
          </thead>
          <tbody class="">
            @foreach ($statuses as $status)
              <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->title }}</td>
                <td class="link-site">{{ $status->link }}</td>
                <td>
                  @if ($status->status == 1)
                      <ul style="padding-left:0">
                        <li><span class="text-success">Работает</span></li>
                      </ul>
                  @else
                  <ul style="padding-left:0">
                    <li><span class="text-danger">Отключен</span></li>
                  </ul>
                  @endif
                </td>
                <td>
                  <a class="btn btn-success" href="{{ route('status.edit',$status->id) }}"><i class="fas fa-pen"></i></a>
                  <form style="display: inline" action="{{ route('status.destroy', $status->id) }}" method="POST">
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
  let links = document.querySelectorAll('.link-site');
  console.log(links)
  
  for(let i =0;i<links.length;i++){
    let status = links[i].parentNode.children[3]
    $.ajax({
        url: links[i].innerText,
        success: function() {
      status.innerHTML = `<span class="text-success"> Работает </span>`
        },
    error:function(){
      document.querySelector('#iconStatus').innerHTML = `<i class="nav-icon far fa-angry"></i>`
      
    }  
    });
  }
  </script>

@endsection
