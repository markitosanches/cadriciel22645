@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('blog.index')}}" class="btn btn-outline-primary">Retourner</a>
            <h4 class="display-6 mt-2">
                {{ $blogPost->title }}
            </h4>
            <hr>
            <p>
                {!! $blogPost->body !!}
            </p>
            <p>
                <strong>Author:</strong> {{ $blogPost->user_id }}
            </p>
        </div>
    </div>
@endsection