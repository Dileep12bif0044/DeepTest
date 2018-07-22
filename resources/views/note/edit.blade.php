@extends('layouts.app')
@section('title')
    Edit Note
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">  
            @if(Session::has('message'))
                <p class="alert alert-success text-center">{{ Session::get('message') }}</p>
            @else
                <h1 class="text-center">Update Note</h1>
                <form action="{{ env('FRONT_USER').'/edit/'.$note->id}}" method="post">
                    
                    <div class="form-group">
                        <label for="title">Title <span class="require">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{$note->title}}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Note Description</label>
                        <textarea rows="7" class="form-control" name="note">{{$note->note}}</textarea>
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
                @endif
            </form>
        </div>
    </div>
</div>
@endsection