@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                    @method('put')
                    @csrf
                    <div class="card-header display-6 text-center">
                            Modifier l'article
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $blogPost->title}}">
                        </div>
                        <div class="control-group col-12">
                            <label for="body">Article</label>
                            <textarea id="body" name="body" class="form-control">{{ $blogPost->body }}</textarea>
                        </div>
                        <div class="control-group col-12">
                            <label for="category">Category</label>
                           <select id="category" class="form-control" name="category_id">
                            <option value="">Select the category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($blogPost->category_id == $category->id) selected @endif>{{$category->category}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Modifier" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection