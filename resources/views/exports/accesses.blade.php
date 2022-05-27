<table>
  <thead>
    <tr>
      <th>id</th>
      <th>Название сайта</th>
      <th>Ссылка</th>
      <th>Логин</th>
      <th>Пароль</th>
      <th>Описание</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($accesses as $access)
      <tr>
        <td>{{ $access->id }}</td>
        <td>{{ $access->title }}</td>
        <td>{{ $access->link }}</td>
        <td>{{ $access->login }}</td>
        <td>{{ $access->pass }}</td>
        <td>{{ $access->description ?? '-' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>