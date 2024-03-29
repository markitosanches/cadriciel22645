@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('temp.password')}}" method="post">
                    @csrf
                    <div class="card-header display-6 text-center">
                            Forgot Password
                    </div>
                    <div class="card-body">
                        @if(!$errors->isEmpty())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>    
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="control-group col-12">
                            <label for="username">Username</label>
                            <input type="email" id="username" name="email" class="form-control" value="{{ old('email')}}">
                            @if($errors->has('email'))
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Reset" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection