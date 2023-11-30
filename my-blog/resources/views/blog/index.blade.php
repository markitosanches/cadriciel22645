@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-8">
            Cliquez sur un article pour le lire!
        </div>
        <div class="col-4">
            <a href="{{ route('blog.create')}}" class="btn btn-primary">Ajouter</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lister les articles</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($blogs as $blog)
                        <li><a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title }}</a></li>
                        @empty
                        <li class="text-danger">Aucun article disponible !</li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>


@endsection

