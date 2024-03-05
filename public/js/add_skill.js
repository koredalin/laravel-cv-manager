document.addEventListener('DOMContentLoaded', function () {
  let addSkillBtn = document.getElementById("add_skill");
  let skillModal = document.getElementById("skill_modal_container");
  let closeSkillModalBtn = document.getElementsByClassName("skill-close")[0];
  let newSkillModalErrors = document.getElementById('skill_modal_errors');

  addSkillBtn.onclick = function () {
    skillModal.style.display = "block";
  };

  closeSkillModalBtn.onclick = function () {
    closeSkillModal();
  };

  // We close the modal on click outside it.
  window.addEventListener('click', function (event) {
    if (event.target === skillModal) {
      closeSkillModal();
    }
  });

  let skillForm = document.getElementById("skill_modal_form");
  skillForm.addEventListener('submit', function (event) {
    event.preventDefault();
    // Събиране на данни от формата
    const formData = {
      name: document.getElementById('skill_name_modal').value
    };

    // Backend request.
    fetch('/api/skill/add_one', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: JSON.stringify(formData)
    })
      .then(response => {
        newSkillModalErrors.innerHTML = '';
        if (response.ok) {
          newSkillModalErrors.classList.add('hidden');

          return response.json();
        }

        if (response.status === 422) {
          return response.json().then(errors => {
            throw errors;
          });
        }

        throw new Error('Network response was not ok');
      })
      .then(data => {
        newSkillModalErrors.innerHTML = '';
        if (!data.success) {
          newSkillModalErrors.innerHTML = data.message;
          return;
        }

        let skillName = document.getElementById('skills');
        let newSkillOption = document.createElement('option');
        newSkillOption.value = data.skill.id;
        newSkillOption.text = data.skill.name;
        newSkillOption.selected = true;
        skillName.prepend(newSkillOption);
        closeSkillModal();
      })
      .catch(errors => {
        newSkillModalErrors.classList.remove('hidden');
        if (errors instanceof Error) {
          // System errors.
          errors.innerHTML = errors.message;
        } else {
          // Validation errors.
          Array.from(errors.errors).forEach((message) => {
            newSkillModalErrors.innerHTML += message + '</br>';
          });
        }
      });
  });

  function closeSkillModal() {
    skillModal.style.display = 'none';
  }
});