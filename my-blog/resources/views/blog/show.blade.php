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
                <strong>Author:</strong> {{ $blogPost->blogHasUser?->name }}
            </p>
            <p>
                <strong>Category:</strong> {{ $blogPost->blogHasCategory?->category }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <a href="{{ route('blog.edit', $blogPost->id)}}" class="btn btn-primary">Modifier</a>
        </div>
        <div class="col-4">
            <a href="{{ route('blog.showPdf', $blogPost->id)}}" class="btn btn-warning">PDF</a>
        </div>
        <div class="col-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Effacer
                </button>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Effacer la donnée</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Etes-vous sûr de efffacer la donnée?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
        <form method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Effacer" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection