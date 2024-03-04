document.addEventListener('DOMContentLoaded', function () {
  let addUniBtn = document.getElementById("add_skill");
  let skillModal = document.getElementById("skill_modal_container");
  let closeUniModalBtn = document.getElementsByClassName("skill-close")[0];
  let errorsModal = document.getElementById('skill_modal_errors');

  addUniBtn.onclick = function () {
    skillModal.style.display = "block";
  };

  closeUniModalBtn.onclick = function () {
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

    fetch('/api/skill/add_one', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: JSON.stringify(formData)
    })
      .then(response => {
        errorsModal.innerHTML = '';
        if (response.ok) {
          errorsModal.classList.add('hidden');

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
        let errors = document.getElementById('skill_modal_errors');
        errors.innerHTML = '';
//        console.log(data);
        if (!data.success) {
          errors.innerHTML = data.message;
          return;
        }

        let skillNames = document.getElementById('skill');
        let newUniOption = document.createElement('option');
        newUniOption.value = data.skill.name;
        skillNames.prepend(newUniOption);
        closeSkillModal();
      })
      .catch(errors => {
        errorsModal.classList.remove('hidden');
        console.error('Error:', errors);
        if (errors instanceof Error) {
          // System errors.
//          console.error(errors.message);
          errors.innerHTML = errors.message;
        } else {
          // Validation errors.
//        console.error(errors);
//        console.log(errors.errors);
          Array.from(errors.errors).forEach((message) => {
            console.log(message);
            errorsModal.innerHTML += message + '</br>';
          });
        }
      });
  });

  function closeSkillModal() {
    skillModal.style.display = 'none';
  }
});