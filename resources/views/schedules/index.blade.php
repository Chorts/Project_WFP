<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedules Page</title>
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
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Day</td>
                    <td style="font-weight:bold">Start Time</td>
                    <td style="font-weight:bold">End Time</td>
                </tr>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->doctor_id }}</td>
                        <td>{{ $schedule->doctor->name }}</td>
                        <td>{{ $schedule->day }}</td>
                        <td>{{ $schedule->start_time}}</td>
                        <td>{{ $schedule->end_time}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>