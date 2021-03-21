@extends('html')

@section('meta-title')
    {{$item->name}}
@stop

@section('title')
    {{$item->name}}
@stop

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('news.list')}}">News</a></li>
                <li class="breadcrumb-item"><a href="{{route('tags.list')}}">Tags</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
            </ol>
        </nav>
    </div>
    <ul>
        @foreach($item->news() as $newItem)
            <li>
                <a href="{{route('news.item', $newItem->slug)}}">{{$newItem->title}}</a>
            </li>
        @endforeach
    </ul>
@stop