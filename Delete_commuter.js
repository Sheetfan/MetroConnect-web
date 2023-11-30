// Function to open the delete confirmation modal
function openDeleteModal(userId) {
    document.getElementById('userIdToDelete').value = userId;
    document.getElementById('deleteModal').style.display = 'block';
}

// Function to close the delete confirmation modal
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    document.getElementById('userIdToDelete').value = '';
}

// Function to confirm deletion
function confirmDeletion() {
    var userId = document.getElementById("userIdToDelete").value;

    if (userId) {
        // AJAX request to delete the record
        fetch('Server/delete_commuter.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `userId=${userId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.message);
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            console.log(error.response);
            alert('An error occurred while deleting the user.');
        });
    }

    closeDeleteModal();
}

// Event listener for the window to close the modal when clicked outside
window.onclick = function(event) {
    var modal = document.getElementById('deleteModal');
    if (event.target === modal) {
        closeDeleteModal();
    }
}
