@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-8">
            <p>Bienvenue dans notre blog</p>
    </div>
    <div class="col-4">
        <a href="{{ route('blog.index')}}" class="btn btn-outline-primary"> Afficher les articles</a>
    </div>
    
    
</div>
@endsection