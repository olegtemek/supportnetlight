@extends('layouts.main')

@section('title','Тарифы сайтов')



@section('content')
<div class="row">
    @if (session('message'))
      <div class="alert alert-success col-12">
          {{ session('message') }}
      </div>
  @endif
  <div class="col-6">
    <a href="{{ route('tariff.create') }}" class="btn btn-success">Добавить запись</a>
    
  </div>
  <div class="col-12 mt-4">
    <div class="card">
    
      <div class="card-body table-responsive p-0" >
        <table class="table table-head-fixed ">
          <thead>
            <tr>
              <th>Название сайта</th>
              <th>Тарифный план</th>
              
              <th>Контент часы</th>
              <th>Разработчик часы</th>
              <th>Дизайнер часы</th>
              <th>Контекст</th>
              <th>Изменить/удалить</th>
            </tr>
          </thead>
          <tbody class="">
            @foreach ($tariffs as $tariff)
              <tr>
                <td>{{ $tariff->title }}</td>
                <td>{{ $tariff->name }}</td>
                
                <td>{{ $tariff->content }}</td>
                <td>{{ $tariff->develop }}</td>
                <td>{{ $tariff->design }}</td>
                <td>{{ $tariff->context }}</td>
                
                <td>
                  <a class="btn btn-success" href="{{ route('tariff.edit',$tariff->id) }}"><i class="fas fa-pen"></i></a>
                  <form style="display: inline" action="{{ route('tariff.destroy', $tariff->id) }}" method="POST">
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

