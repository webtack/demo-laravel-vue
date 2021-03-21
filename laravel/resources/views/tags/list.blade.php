@extends('html')

@section('meta-title')
    {{$title}}
@stop

@section('title')
    {{$title}}
@stop

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('news.list')}}">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tags</li>
            </ol>
        </nav>
    </div>
    <ul>
        @foreach ($items as $item)
            <li>
                <a href="{{route('tags.item', $item->slug)}}">{{$item->name}}</a>
            </li>
        @endforeach
    </ul>
@stop