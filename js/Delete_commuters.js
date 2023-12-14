// Open the delete confirmation modal
function openDeleteModal(userId) {
    // Set the user ID in the hidden input field
    document.getElementById('userIdToDelete').value = userId;
    // Display the modal
    document.getElementById('deleteModal').style.display = 'block';
}

// Close the delete confirmation modal
function closeDeleteModal() {
    // Hide the modal
    document.getElementById('deleteModal').style.display = 'none';
    // Clear the value in the hidden input field
    document.getElementById('userIdToDelete').value = '';
}

// Confirm deletion of the user
function confirmDeletion() {
    // Get the user ID from the hidden input field
    var userId = document.getElementById('userIdToDelete').value;

    // Check if userId is not empty
    if (userId) {
        // Prepare the data to be sent in the POST request
        var formData = new FormData();
        formData.append('userId', userId);

        // Make the POST request to the server to delete the user
        fetch('Server/delete_commuters.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.message);
                // Refresh the page or update the table to reflect the deletion
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the user.');
        });
    }

    // Close the modal
    closeDeleteModal();
}

// Add event listeners to close the modal when clicked outside
window.onclick = function(event) {
    var modal = document.getElementById('deleteModal');
    if (event.target === modal) {
        closeDeleteModal();
    }
}

// Your existing code for other functionalities (like viewHistory, openUpdateForm) can be added here
