<form action="{{ route('cv.age_skills_report') }}" method="GET" class="form-container">
  @csrf

  <div class="form-group">
    <label>Начална дата на кандидатстване</label>
    <div id="cv_created_at_from_datepicker" class="input-group date">
      <input type='text' class="form-control" name="cv_created_at_from" id="cv_created_at_from" placeholder="Дата на кандидатстване" value="{{ old('cv_created_at_from') }}" />
      <span id="cv_created_at_from_icon" class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label>Крайна дата на кандидатстване</label>
    <div id="cv_created_at_to_datepicker" class="input-group date">
      <input type='text' class="form-control" name="cv_created_at_to" id="cv_created_at_to" placeholder="Дата на кандидатстване" value="{{ old('cv_created_at_to') }}" />
      <span id="cv_created_at_to_icon" class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>
  </div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="form-row">
    <input type="submit" id="submit" class="form-control" value="Търсене">
  </div>
</form>