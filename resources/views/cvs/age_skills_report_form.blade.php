<form action="{{ route('cv.age_skills_report') }}" method="GET" class="form-container">
  @csrf

  <div class="form-group">
    <label>От дата на раждане</label>
    <div id="dob_from_datepicker" class="input-group date">
      <input type='text' class="form-control" name="dob_from" id="dob_from" placeholder="Дата на раждане" value="{{ old('dob_from') }}" />
      <span id="dob_from_icon" class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label>До дата на раждане</label>
    <div id="dob_to_datepicker" class="input-group date">
      <input type='text' class="form-control" name="dob_to" id="dob_to" placeholder="Дата на раждане" value="{{ old('dob_to') }}" />
      <span id="dob_to_icon" class="input-group-addon">
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