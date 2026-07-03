<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->
@extends('layouts.adminlte4')
@section('sidebar-articles')
    active
@endsection
@section('title')
    Articles
@endsection
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('status'))
            <div class="alert alert-warning">{{ session('status') }}</div>
        @endif

        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + New Article
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Title</td>
                    <td style="font-weight:bold">Article</td>
                    <td style="font-weight:bold">Date Published</td>
                    <td style="font-weight:bold">Doctor</td>
                </tr>
                @foreach ($articles as $article)
                    <tr id="tr_{{ $article->id }}">
                        <td>{{ $article->id }}</td>
                        <td id="td_title_{{ $article->id }}">{{ $article->title }}</td>
                        <td id="td_article_{{ $article->id }}">{{ $article->article }}</td>
                        <td id="td_date_{{ $article->id }}">{{ $article->date_published }}</td>
                        <td id="td_doctor_{{ $article->id }}">{{ $article->doctor->id }} - {{ $article->doctor->name }}</td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"onclick="getEditForm({{ $article->id }})">Edit</a>

                            @can('delete-permission', Auth::user())
                                <a href="#" class="btn btn-danger btn-sm"onclick="if(confirm('Are you sure to delete {{ $article->id }} - {{ $article->title }}?')) deleteDataRemove({{ $article->id }})">
                                    Delete
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- </body>

                </html> -->
@endsection

@push('modals')
    {{-- Modal Create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.articles.store') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Article</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Article Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Article Title">
                        </div>
                        <div class="form-group mb-2">
                            <label>Article</label>
                            <input type="text" class="form-control" name="article" placeholder="Enter Article here">
                        </div>
                        <div class="form-group mb-2">
                            <label>Date Published</label>
                            <input type="date" class="form-control" name="date" placeholder="Enter Date">
                        </div>
                        <div class="form-group mb-2">
                            <label>Doctor</label>
                            <select class="form-control" name="doctor_id">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Type B --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Article</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('script')
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.articles.getEditForm") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    $('#modalContent').html(data.msg);
                }
            });
        }

        function saveDataUpdate(id) {
            var title = $('#title').val();
            var article = $('#article').val();
            var date_published = $('#date').val();
            var doctor_id = $('#doctor_id').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("admin.articles.saveDataUpdate") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'title': title,
                    'article': article,
                    'date_published': date_published,
                    'doctor_id': doctor_id,
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_title_' + id).html(title);
                        $('#td_article_' + id).html(article);
                        $('#td_date_' + id).html(date_published);
                        $('#td_doctor_' + id).html($('#doctor_id option:selected').text());
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.articles.deleteData") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#tr_' + id).remove();
                    }
                }
            });
        }
    </script>
@endpush