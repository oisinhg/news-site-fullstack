// MODAL
// Get the modal
let modal = document.querySelector("#confirm");
let deleteId;

// Get the <span> element that closes the modal
let modalClose = document.querySelector("#modal-cancel");
let modalDelete = document.querySelector("#modal-delete");

document.addEventListener('click', function (event) {
    if (event.target.id === "delete-btn") {
        modal.style.display = "block";
        deleteId = event.target.dataset.id;
    }
});

// When the user clicks on close, close the modal
modalClose.addEventListener('click', () => {
    modal.style.display = "none";
});

modalDelete.addEventListener('click', async () => {
    // let deleteId = btn.dataset.id;

    const formData = new FormData();
    formData.append("id", deleteId);

    const response = await fetch("story_delete.php", {
        method: "POST",
        // Set the FormData instance as the request body
        body: formData,
    });

    // formInput.value = deleteId;
    window.location.replace("story_table.php");
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}