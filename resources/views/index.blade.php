@extends('layouts.app')

@section('title', $title)

@section('content')

<div id="top_scores">
    <h1>@yield('title')</h1>
    
    <div>
        @include('cvs.create')
    </div>
</div>

<div id="internal_links">
  <?php //<p><a href="{{ route('statistics') }}">Statistics</a></p> ?>
</div>
@endsection