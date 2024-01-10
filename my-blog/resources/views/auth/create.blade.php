@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="card-header display-6 text-center">
                            @lang('lang.text_add_new')
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label for="name"> @lang('lang.text_name')</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name')}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="control-group col-12">
                            <label for="username"> @lang('lang.text_username')</label>
                            <input type="email" id="username" name="email" class="form-control" value="{{ old('email')}}">
                            @if($errors->has('email'))
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="control-group col-12">
                            <label for="password"> @lang('lang.text_password')</label>
                            <input type="password" id="password" name="password" class="form-control">
                            @if($errors->has('password'))
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="@lang('lang.text_save')" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection