@extends('layouts.member')

@section('title', $article->title ?? 'Artikel Kesehatan')
@section('nav-articles', 'active')

@section('content')
<div class="container mt-4">

    <a href="{{ route('member.articles.index') }}" class="btn btn-secondary mb-3">
        Kembali
    </a>

    @if(!$article)

    <div class="alert alert-danger">
        Artikel tidak ditemukan.
    </div>

    @else

    <div class="card">
        <div class="card-body">

            <h2>{{ $article->title }}</h2>

            <p class="text-muted">
                Dokter: {{ $article->doctor->name ?? 'Dokter' }}
            </p>

            <p class="text-muted">
                Tanggal Publikasi:
                {{ \Carbon\Carbon::parse($article->date_published)->format('d M Y') }}
            </p>

            <hr>

            <p>
                {!! nl2br(e($article->article)) !!}
            </p>

        </div>
    </div>

    @endif

</div>
@endsection