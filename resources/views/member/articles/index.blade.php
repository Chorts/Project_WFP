@extends('layouts.member')

@section('title', 'Artikel Kesehatan')
@section('nav-articles', 'active')

@section('content')
<div class="container mt-4">

    <h2>Artikel Kesehatan</h2>
    <p>Baca artikel kesehatan dari dokter kami.</p>

    <form action="{{ route('member.articles.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Cari artikel...">

            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </div>
    </form>

    @if($articles->isEmpty())
    <div>
        Tidak ada artikel ditemukan.
    </div>
    @else

    <div class=" row">
        @foreach($articles as $article)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">

                <div class="card-body">
                    <h5 class="card-title">
                        {{ $article->title }}
                    </h5>

                    <p class="card-text">
                        {{ Str::limit(strip_tags($article->article), 100) }}
                    </p>

                    <p class="text-muted mb-2">
                        Dokter: {{ $article->doctor->name ?? 'Dokter' }}
                    </p>

                    <p class="text-muted">
                        {{ \Carbon\Carbon::parse($article->date_published)->format('d M Y') }}
                    </p>

                    <a href="{{ route('member.articles.show', $article->id) }}"
                        class="btn btn-primary">
                        Baca Selengkapnya
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    @endif

</div>
@endsection