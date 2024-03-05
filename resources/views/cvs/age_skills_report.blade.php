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
  @include('cvs.age_skills_report_form')

  <div id="cvs_container">
    <h2 class="text-center">Извадка</h2>
    <table id="cvs_table">
      <thead>
        <tr>
          <th>Брой кандидати</th>
          <th>Възраст</th>
          <th>Умения</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->candidates_count }}</td>
            <td>{{ $user->age }}</td>
            <td>{{ $user->skills_list }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @if (!empty($users))
        {{ $users->links() }}
    @endif
  </div>
</div>

<div id="internal_links" class="text-center">
    <p><a href="{{ route('cv.add_one') }}">Създаване на CV</a></p>
    <p><a href="{{ route('cv.search_by_dobs') }}">Търсене на CV по период на раждане</a></p>
</div>
@endsection