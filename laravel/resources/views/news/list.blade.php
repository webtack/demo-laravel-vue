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
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
    </div>
    <div>
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{route('news.item', $item->slug)}}">{{$item->id}}: {{$item->title}} ({{$item->slug}})</a>
                </li>
            @endforeach
        </ul>
    </div>

@stop