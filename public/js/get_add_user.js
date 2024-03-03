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

    requestPending = true;

    const userData = {
      name: name.value,
      middle_name: middleName.value,
      surname: surname.value,
      dob: dob.value,
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
        // TODO - Form population if an user with filled CV exists.
      }).catch(error => console.error('Error processing JSON:', error));
    })
    .catch(error => console.error('Error:', error));
  }

  window.checkUserExistence = checkUserExistence;

  [name, middleName, surname].forEach(element => {
    element.addEventListener('change', checkUserExistence);
  });
});