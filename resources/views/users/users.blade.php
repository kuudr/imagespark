@extends('template')
@section('content')
    <div class="main__center">
        <a class="btn" href="/users/create">Создать пользователя </a>
    </div>
    <table class="show_users">
        <tr class="table_line">
            <th>Логин</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Email</th>
            <th>Адрес</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($users as $userView)
        <tr class="table_row">
            <td>{{ $userView->login }}</td>
            <td>{{ $userView->name }}</td>
            <td>{{ $userView->surname }}</td>
            <td>{{ $userView->email }}</td>
            <td>{{ $userView->address }}</td>
            <td>
                <a href="{{ route('users.show', $userView->id) }}" class="btn-users">View</a>
                <a href="{{ route('users.edit', $userView->id) }}"
                   class="btn-users">Update</a>
                <form method="post" action =  "{{ route('users.destroy', $userView->id) }}">
                    @csrf
                    @method('DELETE')
                    <button  onclick="return confirm('Вы уверены, что хотите удалить пользователя?')" class="btn-users">Delete</button>
                </form>
            </td>
            @endforeach

        </tr>
    </table>
    <div class="main__center">
    {{ $users->links("pagination::bootstrap-4") }}
    </div>
@endsection


