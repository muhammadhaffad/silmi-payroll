<table>
    <thead>
    <tr>
        <th>Username</th>
        <th>Nama</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->nama }}</td>
        </tr>
    @endforeach
    </tbody>
</table>