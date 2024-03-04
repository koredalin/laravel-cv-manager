document.addEventListener('DOMContentLoaded', function () {
  const name = document.getElementById('name');
  const middleName = document.getElementById('middle_name');
  const surname = document.getElementById('surname');
  const dob = document.getElementById('dob');

  function checkFieldsFilled() {
    return name.value.length && middleName.value.length && surname.value.length && dob.value.length;
  }

  function checkUserExistence() {
    if (!checkFieldsFilled()) {

      return;
    }

    const userData = {
      name: name.value,
      middle_name: middleName.value,
      surname: surname.value,
      dob: dob.value
    };

    fetch('/api/user/get_add_one', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: JSON.stringify(userData)
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const clonedResponse = response.clone();
      clonedResponse.json().then(data => {
        console.log("Data:", data);
        populateUniversitySkills(data);
      }).catch(error => console.error('Error processing JSON:', error));
    })
    .catch(error => console.error('Error:', error));
  }

  window.checkUserExistence = checkUserExistence;
  
  function populateUniversitySkills(data) {
    let emptyUser = !data.hasOwnProperty('user') || !data.user;
    // We do nothing on an empty response.
    if (emptyUser) {
      return;
    }
    
    let user = data.user;
    
    let isUniversity = user.hasOwnProperty('university')
      && user.university
      && user.university.hasOwnProperty('name')
      && user.university.name.length;
    if (isUniversity) {
      let uniesGrid = document.getElementById('universities_names');
      let newOption = document.createElement('option');
      newOption.selected = true;
      newOption.value = user.university.name;
      uniesGrid.prepend(newOption);
    }

    let hasSkills = user.hasOwnProperty('skills')
      && user.skills
      && Array.isArray(user.skills)
      && user.skills.length;
    if (hasSkills) {
      let skillsOptions = document.getElementById('skills').options;
      Array.from(skillsOptions).forEach((skillOpt) => {
        skillOpt.selected = false;
        user.skills.forEach((dbSkillObj) => {
          if (skillOpt.value && dbSkillObj.id && parseInt(skillOpt.value ?? 0) === parseInt(dbSkillObj.id ?? 0)) {
            skillOpt.selected = true;
          }
        });
      });
    }
  }

  [name, middleName, surname].forEach(element => {
    element.addEventListener('change', checkUserExistence);
  });
});