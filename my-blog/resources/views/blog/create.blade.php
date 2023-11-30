@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="card-header display-6 text-center">
                            Ajouter un article
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="title" class="form-control">
                        </div>
                        <div class="control-group col-12">
                            <label for="body">Article</label>
                            <textarea id="body" name="body" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Sauvegarder" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection