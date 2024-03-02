@extends('layouts.app')

@section('title', $title)

@section('content')

<div id="top_scores">
    <h1>@yield('title')</h1>
    <h2>Top Scores</h2>
    
    
</div>

<div id="internal_links">
  <?php //<p><a href="{{ route('questionnaires') }}">Questionnaires List</a></p> ?>
</div>
@endsection