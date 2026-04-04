<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->availability }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->category_id }}</td>
                        <td>{{ $service->category->category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>