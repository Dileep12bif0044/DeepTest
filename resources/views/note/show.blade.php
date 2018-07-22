@extends('layouts.app')
@section('title')
    Welcome
@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="row"> 
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="list-group">
                        <div class="list-group-item">
                            <p>Posted by</p>
                            <a href="#" title="sintret">
                                {{ucfirst($note[0]->name)}}
                            </a>
                        </div>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-9 col-md-9">
                    <h4 class="text-left">{{ucfirst($note[0]->title)}}</h4>
                    <p class="text-left">{{ucfirst($note[0]->note)}}</p>
                    <div>
                        <span class="badge pull-left">CreatedAt {{ $note[0]->created_at->diffForHumans()}}</span>
                        <span class="badge pull-left">Views {{ count(json_decode($note[0]->users_views)) }}</span>
                        @if(Auth::check())
                            @if(Auth::user()->id == $note[0]->user_id)
                            <div class="pull-right">
                                <a class="btn btn-warning" href="{{ env('FRONT_USER').'/edit/'.$note[0]->id}}">Edit</a>
                                <a class="btn btn-danger" href="{{ env('FRONT_USER').'/destroy/'.$note[0]->id}}">Delete</a>
                            </div>
                            @endif
                        @endif
                    </div>
                </div> 
            </div>
            <hr>
        </div>
    </div>
@endsection
