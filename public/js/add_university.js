document.addEventListener('DOMContentLoaded', function () {
  let universityModal = document.getElementById("university_modal_container");
  let addUniBtn = document.getElementById("add_university");
  let closeUniBtn = document.getElementsByClassName("university-close")[0];


  addUniBtn.onclick = function () {
    universityModal.style.display = "block";
  };


  closeUniBtn.onclick = function () {
    universityModal.style.display = "none";
  };

  window.addEventListener('click', function (event) {
    if (event.target === universityModal) {
      universityModal.style.display = 'none';
    }
  });

  document.getElementById("university_modal_form").onsubmit = function (event) {
    event.preventDefault();

    // TODO - Call backend API.
  };
});