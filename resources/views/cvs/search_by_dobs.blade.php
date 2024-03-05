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
  @include('cvs.search_by_dobs_form')

  <div id="cvs_container">
    <h2 class="text-center">Извадка</h2>
    <table id="cvs_table">
      <thead>
        <tr>
          <th>Име</th>
          <th>Презиме</th>
          <th>Фамилия</th>
          <th>Дата на раждане</th>
          <th>Университет</th>
          <th>Умения</th>
          <th>CV подадено на</th>
          <th>CV обновено на</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          @if (empty($user->cv))
            @continue
          @endif
          @php
            $skillsNames = [];
          @endphp
          @foreach($user->skills as $skill)
            @php
              $skillsNames[] = $skill->name;
            @endphp
          @endforeach
          @php
            $skillsText = implode(',', $skillsNames);
          @endphp
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->middle_name }}</td>
            <td>{{ $user->surname }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->university ? $user->university->name : '' }}</td>
            <td>{{ $skillsText }}</td>
            <td>{{ $user->cv ? $user->cv->created_at->format("Y-m-d") : '' }}</td>
            <td>{{ $user->cv ? $user->cv->created_at->format("Y-m-d") : '' }}</td>
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
    <p><a href="{{ route('cv.age_skills_report') }}">Справка по възраст и умения</a></p>
</div>
@endsection