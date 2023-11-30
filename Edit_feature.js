function openUpdateForm(userId) {
    document.getElementById('userId').value = userId;
    fetchUserData(userId);
    document.getElementById('updateModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('updateModal').style.display = 'none';
}

window.onclick = function(event) {
    var modal = document.getElementById('updateModal');
    if (event.target == modal) {
        closeModal();
    }
}

document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch('Server/update_commuter.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert("Successfully Updated");
        location.reload();
    })
    .catch(error => {
        console.log('Error:', error);
        alert('An error occurred while updating the user.');
    });
});

function fetchUserData(userId) {
    fetch('Server/Endpoint_data.php?userId=' + userId)
    .then(response => response.json())
    .then(data => {
        document.getElementById('firstName').value = data.First_Name || '';
        document.getElementById('lastName').value = data.Last_Name || '';
        document.getElementById('email').value = data.Email_Address || '';
        document.getElementById('contactNumber').value = data.Commuter_Number || '';
    })
    .catch(error => {
        console.log('Error fetching user data:', error);
    });
}
