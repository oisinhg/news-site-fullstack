const dropdown = document.querySelector(".dropdown-content");
const dropdownBtn = document.querySelector("#dropbtn");

let editBtn = document.querySelector('#toggle-edit');
let actionDiv = document.querySelectorAll('.actions');

let adminPanel = document.querySelector('.dropdown');
let loginBtn = document.querySelector('#login-li');

console.log(document.querySelector('#login_status').value);

if (document.querySelector('#login_status').value == 'true') {
  loginBtn.style.display = 'none';
  adminPanel.style.display = 'inline-block';

  actionDiv.forEach((actions) => {
    actions.style.display = 'flex';
  });
}
else {
  adminPanel.style.display = 'none';
  loginBtn.style.display = 'block';
}

document.addEventListener("click", e => {
  if (dropdownBtn.contains(e.target)) {
    // Button clicked: toggle
    dropdown.classList.toggle("show");
  } else if (!dropdown.contains(e.target)) {
    // Clicked out: hide
    dropdown.classList.remove("show");
  }
});

document.addEventListener('click', event => {
  let selectedStoryDiv = event.target.closest('.story');

  if (selectedStoryDiv !== null && event.target !== selectedStoryDiv.querySelector('#delete-btn')) {
    let storyId = selectedStoryDiv.dataset.id;
    console.log(event.target);

    window.location.href = `story_view.php?id=${storyId}`;
  }
});
