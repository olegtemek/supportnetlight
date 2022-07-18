@extends('layouts.main')

@section('title','Тариф - редактировать')

@section('content')
<div class="row">
  <div class="card card-warning col-sm-12">
    <div class="card-header">
      <h3 class="card-title">Редактировать запись</h3>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('tariff.update',$tariff->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
             
              <label>Название сайта</label>
              @error('title')
              <span class="error text-danger">{{ $message }}</span>
              @enderror
              <input type="text" value="{{ $tariff->title }}" class="form-control" name="title" placeholder="Название сайта">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
             <label for="">Выбор тарифа</label>
             <select name="tariff" id="" class="form-control">
              <option value="1" {{ $tariff->name == 'Метеорит' ? 'selected': '' }}>Метеорит</option>
              <option value="2" {{ $tariff->name == 'Астероид' ? 'selected': '' }}>Астероид</option>
              <option value="3" {{ $tariff->name == 'Комета' ? 'selected': '' }}>Комета</option>
              <option value="4" {{ $tariff->name == 'Спутник' ? 'selected': '' }}>Спутник</option>
              <option value="5" {{ $tariff->name == 'Планета' ? 'selected': '' }}>Планета</option>
             </select>
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