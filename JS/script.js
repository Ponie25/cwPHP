
function toggleModal(modalID) {
    document.getElementById(modalID).classList.toggle("hidden");
}

function openEditModal(id, title, content) {
    // Set the values in the modal fields
    document.getElementById('postId').value = id;
    document.getElementById('postTitle').value = title;
    document.getElementById('postContent').value = content;

    // Display the modal
    document.getElementById('editModal').classList.remove('hidden');
}

console.log("Script loaded"); 
