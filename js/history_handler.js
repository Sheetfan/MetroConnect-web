function viewHistory(userId) {
    document.getElementById('historyUserId').textContent = userId;
    fetch(`Server/view_history.php?userId=${userId}`)
        .then(response => response.json())
        .then(data => {
            displayHistoryData(data);
            document.getElementById('historyModal').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
}

function closeHistoryModal() {
    document.getElementById('historyModal').style.display = 'none';
}

function displayHistoryData(historyData) {
    const historyContent = document.getElementById('historyContent');
    historyContent.innerHTML = ''; // Clear existing content
    historyData.forEach(item => {
        // Create and append the history item
        // Modify as per your data structure
        const div = document.createElement('div');
        div.textContent = `Timestamp: ${item.Timestamp}, Amount: ${item.Amount}`;
        historyContent.appendChild(div);
    });
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('historyModal');
    if (event.target == modal) {
        closeHistoryModal();
    }
};
