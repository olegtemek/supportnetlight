<table>
  <thead>
    <tr>
      <th>id</th>
      <th>Название сайта</th>
      <th>Имя клиента</th>
      <th>Номер клиента</th>
      <th>Выполненные работы</th>
      <th>Поддержка до:</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($supports as $support)
      <tr>
        <td>{{ $support->id }}</td>
        <td>{{ $support->title }}</td>
        <td>{{ $support->name }}</td>
        <td>{{ $support->number }}</td>
        <td>{{ $support->completed ?? '-' }}</td>
        <td>{{ $support->support_end }}</td>
      </tr>
    @endforeach
  </tbody>
</table>