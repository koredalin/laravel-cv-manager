document.addEventListener('DOMContentLoaded', function () {
  let addUniBtn = document.getElementById("add_university");
  let universityModal = document.getElementById("university_modal_container");
  let closeUniModalBtn = document.getElementsByClassName("university-close")[0];
  let newUniModalErrors = document.getElementById('university_modal_errors');

  addUniBtn.onclick = function () {
    universityModal.style.display = "block";
  };

  closeUniModalBtn.onclick = function () {
    closeUniversityModal();
  };

  // We close the modal on click outside it.
  window.addEventListener('click', function (event) {
    if (event.target === universityModal) {
      closeUniversityModal();
    }
  });

  let universityForm = document.getElementById("university_modal_form");
  universityForm.addEventListener('submit', function (event) {
    event.preventDefault();
    // Form data collection
    const formData = {
      name: document.getElementById('university_name_modal').value,
      assessment: document.getElementById('assessment_modal').value
    };

    // Backend request.
    fetch('/api/university/add_one', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: JSON.stringify(formData)
    })
      .then(response => {
        newUniModalErrors.innerHTML = '';
        if (response.ok) {
          newUniModalErrors.classList.add('hidden');

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
        newUniModalErrors.innerHTML = '';
//        console.log(data);
        if (!data.success) {
          newUniModalErrors.innerHTML = data.message;
          return;
        }

        let universityNames = document.getElementById('universities_names');
        let newUniOption = document.createElement('option');
        newUniOption.value = data.university.name;
        universityNames.prepend(newUniOption);
        closeUniversityModal();
      })
      .catch(errors => {
        newUniModalErrors.classList.remove('hidden');
        console.error('Error:', errors);
        if (errors instanceof Error) {
          // System errors.
//          console.error(errors.message);
          errors.innerHTML = errors.message;
        } else {
          // Validation errors.
//        console.log(errors.errors);
          Array.from(errors.errors).forEach((message) => {
            console.log(message);
            newUniModalErrors.innerHTML += message + '</br>';
          });
        }
      });
  });

  function closeUniversityModal() {
    universityModal.style.display = 'none';
  }
});