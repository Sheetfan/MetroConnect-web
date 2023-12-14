const tbody = document.querySelector("tbody");
const commuterType = document.querySelector(".commuter_type");

function run(CommuterT) {
    if (!CommuterT) {
        tbody.innerHTML = "<tr><td colspan='5'>Please select a commuter type.</td></tr>";
        return;
    }

    const url = `Server/Price Server.php?commutertype=${encodeURIComponent(CommuterT)}`;
    
    fetch(url).then(function(response) {
        return response.text();
    }).then(function(html) {
        tbody.innerHTML = html;
    }).catch(function(err) {
        console.error(err);
        tbody.innerHTML = "<tr><td colspan='5'>Error loading data.</td></tr>";
    });
}

commuterType.addEventListener("change", function() {
    run(commuterType.value);
});

// Optionally, call `run()` on page load with a default value or an empty string
run(commuterType.value);


// Function to open the add modal
function openAddModal() {
    document.getElementById('addPriceModal').style.display = 'block';
}

// Function to close the add modal
function closeAddModal() {
    document.getElementById('addPriceModal').style.display = 'none';
}

// Handle form submission
document.getElementById('addPriceForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('Server/add_price.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        closeAddModal();
        // Reload or update table data here
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred.');
    });
});

// Attach event listener to your add button
document.querySelector('.btn-modify').addEventListener('click', openAddModal);
