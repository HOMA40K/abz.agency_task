<body>
    <h1>Users List</h1>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }}</li>
            <li>{{ $user->email}}</li>
            <li>{{ $user->mail}}</li>
        @endforeach
    </ul>
</body>
</html>