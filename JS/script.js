function uploadModal() {
    document.getElementById("uploadModal").classList.toggle("hidden");
}

function toggleModal(modalID) {
    document.getElementById(modalID).classList.toggle("hidden");
}

<<<<<<< HEAD
function openEditModal(id, title, content) {
    // Set the values in the modal fields
    document.getElementById('postId').value = id;
    document.getElementById('postTitle').value = title;
    document.getElementById('postContent').value = content;

    // Display the modal
    document.getElementById('editModal').classList.remove('hidden');
}
=======
function openEditModal(postId, title, content) {
    // Set the values in the modal
    document.getElementById('editPostId').value = postId;
    document.getElementById('editTitle').value = title;
    document.getElementById('editContent').value = content;

    // Show the modal
    toggleModal('editModal');
}
>>>>>>> 574914f (New update)
