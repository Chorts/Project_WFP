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
                    <td style="font-weight:bold">Patient Name</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Schedule ID</td>
                    <td style="font-weight:bold">Status</td>
                    <td style="font-weight:bold">Booking Date</td>
                </tr>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->patient_name }}</td>
                        <td>{{ $booking->doctor->name }}</td>
                        <td>{{ $booking->schedule->day }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->booking_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>