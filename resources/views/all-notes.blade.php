@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                @if(Session::has('message'))
                    <p class="alert alert-success text-center">{{ Session::get('message') }}</p>
                @endif
                    <h4 class="text-center">Your All Publish Notes</h3>
                </div>
                <div class="panel-body">
                @if($notes)
                    @foreach($notes as $note)
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4 class="text-left">
                                    <a href="{{ env('FRONT_USER').'/show/'.$note->id.'/'.$note->slug}}">{{$note->short_url}}
                                    </a>
                                </h4>
                                <p class="text-left max-lines">{{ucfirst($note->note)}}</p>
                            </div>
                            <span class="badge pull-right">CreatedAt {{ $note->created_at->diffForHumans()}}</span>
                        </div>
                        <hr>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
