const dashboard = document.querySelector("#dashboard");
const transcation = document.querySelector("#transcation");
const notifications = document.querySelector("#notifications");

window.addEventListener("DOMContentLoaded", ()=>{loadData("dashboard")});
dashboard.addEventListener("click", () => {
	loadData("dashboard");

});
transcation.addEventListener("click", () => {
    loadData("transcation");
});
notifications.addEventListener("click", () => {
    loadData("notification");
});


function loadData(option) {
	// Create a new fetch request with the selected option
	fetch(`Server/${option}.php`)
		.then((response) => {
			console.log("Request URL:", response.url);
			return response.text();
		})
		.then((html) => {
			// Set the received HTML as the content of the 'dynamicContent' element
			document.querySelector(".zone-container").innerHTML = html;
		})
		.catch((error) => {
			console.error("Error:", error);
		});
    console.log(option);
}
