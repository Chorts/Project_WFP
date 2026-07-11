@extends('layouts.member')

@section('title', $article->title ?? 'Artikel Kesehatan')
@section('nav-articles', 'active')

@section('content')

<div class="lb-page-header">
    <div class="container">
        <h1>{{ $article->title ?? 'Artikel Kesehatan' }}</h1>
        @if($article)
        <p>
            <i class="bi bi-person-badge me-1"></i>{{ $article->doctor->name ?? 'Dokter' }}
            &nbsp;&middot;&nbsp;
            <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($article->date_published)->format('d M Y') }}
        </p>
        @endif
    </div>
</div>

<div class="container mb-5">

    <a href="{{ route('member.articles.index') }}" class="btn btn-lb-outline mb-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>

    @if(!$article)

    <div class="lb-empty">
        <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
        Artikel tidak ditemukan.
    </div>

    @else

    <div class="lb-card">
        <div class="p-4 p-md-5">
            <p style="line-height: 1.9;">
                {!! nl2br(e($article->article)) !!}
            </p>
        </div>
    </div>

    @endif

</div>
@endsection
