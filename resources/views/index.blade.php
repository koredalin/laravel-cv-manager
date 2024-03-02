@extends('layouts.app')

@section('title', $title)

@section('content')

<h1>@yield('title')</h1>
    
<div id="body_container">
  @include('cvs.create')
</div>

<div id="internal_links">
  <?php //<p><a href="{{ route('statistics') }}">Statistics</a></p> ?>
</div>
@endsection