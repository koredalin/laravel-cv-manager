@extends('layouts.app')

@section('title', $title)

@section('content')

<h1>@yield('title')</h1>

@if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
@endif

<div id="body_container">
  @include('cvs.create_one_forms')
</div>

<div id="internal_links" class="text-center">
    <p><a href="{{ route('cv.search_by_dobs') }}">Търсене по период на раждане</a></p>
    <p><a href="{{ route('cv.age_skills_report') }}">Справка по възраст и умения</a></p>
</div>
@endsection