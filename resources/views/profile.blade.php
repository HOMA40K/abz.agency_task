<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<style>
    td{
        padding: 6px;
        padding-bottom: 0;
    }
    th{
        padding: 6px;        
        padding-bottom: 0;
    }
</style>
<body>
    
    <H1>Profile Page</H1>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>email_verified_at</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->email_verified_at}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
        </tr>
    </table>
</body>
</html>