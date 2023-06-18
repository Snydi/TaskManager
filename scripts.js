function deletionCheck() {
    return confirm("Are you sure you want to delete this task?");
}
function openForm() {
    document.getElementById("editForm").style.display = "block";
}

function closeForm() {
    document.getElementById("editForm").style.display = "none";
}