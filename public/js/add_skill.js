document.addEventListener('DOMContentLoaded', function () {
  let skillModal = document.getElementById("skill_modal_container");
  let addSkillBtn = document.getElementById("add_skill");
  let closeSkillBtn = document.getElementsByClassName("skill-close")[0];

  addSkillBtn.onclick = function() {
    skillModal.style.display = "block";
  };

  closeSkillBtn.onclick = function() {
    skillModal.style.display = "none";
  };

  window.addEventListener('click', function (event) {
    if (event.target === skillModal) {
      skillModal.style.display = 'none';
    }
  });

  document.getElementById("university_modal_form").onsubmit = function(event) {
    event.preventDefault();

    // TODO - Call backend API.
  };
});