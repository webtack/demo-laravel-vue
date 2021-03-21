@extends('html')

@section('meta-title')
    {{$item->title}}
@stop

@section('title')
    {{$item->title}}
@stop

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('news.list')}}">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$item->title}}</li>
            </ol>
        </nav>
    </div>
    <div>
        {{$item->body}}
    </div>
    <div class="mt-5">
        <h4>Tags</h4>
        <hr>

        <ul>
            @foreach($item->tags() as $tag)
                <li>
                    <a href="{{route('tags.item', $tag->slug)}}">{{$tag->name}}</a>
                </li>
            @endforeach
        </ul>
    </div>
@stop