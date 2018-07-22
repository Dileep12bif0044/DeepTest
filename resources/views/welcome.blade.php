@extends('layouts.app')
@section('title')
    Welcome
@endsection
@section('content')
    <div class="container">
        <div class="content">
            @foreach($notes as $note)
                <div class="row"> 
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                        <h4 class="text-left">
                            <a href="{{ env('FRONT_USER').'/show/'.$note->id.'/'.$note->slug}}">{{$note->short_url}}
                            </a>
                        </h4>
                        <p class="text-left max-lines">{{ucfirst($note->note)}}</p>
                        <span class="badge pull-left">PublishedAt {{ $note->created_at->diffForHumans()}}</span>
                    </div> 
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection
