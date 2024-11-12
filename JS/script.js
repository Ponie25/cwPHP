
function toggleModal(modalID) {
    document.getElementById(modalID).classList.toggle("hidden");
}

function openEditModal(id, title, content) {
    document.getElementById('postId').value = id;
    document.getElementById('postTitle').value = title;
    document.getElementById('postContent').value = content;

    document.getElementById('editModal').classList.remove('hidden');
}

console.log("Script loaded"); 
