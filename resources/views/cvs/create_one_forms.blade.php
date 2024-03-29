<form action="{{ route('cv.create_one') }}" method="POST" class="form-container">
  @csrf

  <div class="form-group">
    <label for="name" class="form-label">Име</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Име" value="{{ old('name') }}" autocomplete="on" >
  </div>

  <div class="form-group">
    <label for="middle_name" class="form-label">Презиме</label>
    <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Презиме" value="{{ old('middle_name') }}" autocomplete="on" >
  </div>

  <div class="form-group">
    <label for="surname" class="form-label">Фамилия</label>
    <input type="text" class="form-control" name="surname" id="surname" placeholder="Фамилия" value="{{ old('surname') }}" autocomplete="on" >
  </div>

  <div class="form-group">
    <label>Дата на раждане</label>
    <div id="dob_datepicker" class="input-group date">
      <input type='text' class="form-control" name="dob" id="dob" placeholder="Дата на раждане" value="{{ old('dob') }}" />
      <span id="dob_icon" class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="university_name" class="form-label">Университет</label>
      <div class="form-control-container">
        <input list="universities_names" name="university_name" id="university_name" class="form-control" placeholder="Университет" />
        <datalist id="universities_names">
          <!--            The options are filled automatically.-->
        </datalist>
        <button id="add_university" type="button" class="btn btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="skills">Име на технология</label>
      <div class="form-control-container">
        <select name="skills[]" id="skills" class="form-control" multiple>
          @foreach ($skills as $skill)
            <option value="{{ $skill->id }}" {{ (collect(old('skills'))->contains($skill->id)) ? 'selected':'' }}>{{ $skill->name }}</option>
          @endforeach
        </select>
        <button id="add_skill" type="button" class="btn btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"></path>
          </svg>
        </button>
      </div>
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
    <input type="submit" id="cv_submit" class="form-control" value="Запис на CV">
  </div>
</form>

<div id="university_modal_container" class="modal">
  <div class="modal-content">
    <span class="university-close">&times;</span>
    <form id="university_modal_form">
      <div class="form-group">
        <label for="university_name_modal">Име на университета</label>
        <input type="text" id="university_name_modal" name="university_name_modal" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="assessment_modal">Акредитационна оценка (0.00 - 10.00):</label>
        <input type="number" id="assessment_modal" name="assessment_modal" step="0.01" min="0" max="10" class="form-control" required>
      </div>
      <div id="university_modal_errors" class="hidden red"></div>
      <button type="submit" id="university_modal_submit" class="btn btn-primary">Добави</button>
    </form>
  </div>
</div>

<div id="skill_modal_container" class="modal">
  <div class="modal-content">
    <span class="skill-close">&times;</span>
    <form id="skill_modal_form">
      <div class="form-group">
        <label for="skill_name_modal">Име на технология</label>
        <input type="text" id="skill_name_modal" name="skill_name_modal" class="form-control" required>
      </div>
      <div id="skill_modal_errors" class="hidden red"></div>
      <button type="submit" class="btn btn-primary">Добави</button>
    </form>
  </div>
</div>

@push('scripts')
<script src="/js/get_add_user.js"></script>
<script src="/js/fill_universities_names.js"></script>
<script src="/js/add_university.js"></script>
<script src="/js/add_skill.js"></script>
@endpush