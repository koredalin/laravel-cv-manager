<form action="/foo/bar" method="POST">
  @csrf

  <div class="form-group">
    <label for="name" class="form-label">Име</label>
    <input type="text" class="form-control" id="name" placeholder="Име">
  </div>

  <div class="form-group">
    <label for="middle_name" class="form-label">Презиме</label>
    <input type="text" class="form-control" id="middle_name" placeholder="Презиме">
  </div>

  <div class="form-group">
    <label for="surname" class="form-label">Фамилия</label>
    <input type="text" class="form-control" id="surname" placeholder="Фамилия">
  </div>

  <div class="form-group">
    <label>Дата на раждане</label>
    <div id="dob_datepicker" class="input-group date">
      <input type='text' class="form-control" name="dob" id="dob" placeholder="Дата на раждане" />
      <span id="dob_icon" class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label for="university" class="form-label">Университет</label>
    <input list="universities" name="university" id="university" class="form-control" placeholder="Университет" />
    <datalist id="universities">
      <option value="ue-varna">
      <option value="tu-varna">
      <option value="vsu-varna">
      <option value="su-sofia">
    </datalist>
  </div>

  <div class="form-group">
    <label for="skills">Choose a car:</label>
    <select name="skills" id="skills" class="form-control" multiple>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
    </select>
  </div>
  
  <div class="form-group">
    <input type="button" name="submit" id="submit" class="form-control" value="Запис на CV">
  </div>
</form>