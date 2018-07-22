@extends('layouts.app')
@section('title')
    Welcome
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2"> 
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="text-center">{{ $error }}</p>
                    @endforeach
                </div>
            @endif 
            @if(Session::has('message'))
                <p class="alert alert-success text-center">{{ Session::get('message') }}</p>
            @endif          
            <h1 class="text-center">Create Note</h1>
            <form action="{{ route('notes.store') }}" method="POST">
                
                <div class="form-group">
                    <label for="title">Title <span class="require">*</span></label>
                    <input type="text" class="form-control" name="title" />
                </div>
                
                <div class="form-group">
                    <label for="note">Note Description</label>
                    <textarea rows="7" class="form-control" name="note" ></textarea>
                </div>
                
                <div class="form-group">
                    <p><span class="require">*</span> - required fields</p>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                    <button class="btn btn-default">
                        Cancel
                    </button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection