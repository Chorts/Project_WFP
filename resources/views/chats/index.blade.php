<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">User ID</td>
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Chat</td>
                    <td style="font-weight:bold">Time</td>
                </tr>
                @foreach ($chats as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->user_id }}</td>
                        <td>{{ $c->doctor_id }}</td>
                        <td>{{ $c->chat }}</td>
                        <td> {{ $c->created_at }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>