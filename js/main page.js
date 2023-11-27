const dashboard = document.querySelector("#dashboard");
const historyPage = document.querySelector("#history");
const notifications = document.querySelector("#notifications");
const headingName = document.querySelector(".heading-name");
const transactionFilter = document.querySelector(".transaction-filters");
let filterDate;
let filterTransations;
window.addEventListener("DOMContentLoaded",() => {
	loadData("dashboard");
});
dashboard.addEventListener("click", () => {
	filterDate.remove();
	filterTransations.remove();
	loadData("dashboard");
});
historyPage.addEventListener("click", () => {
    loadData("history","transactions");
	makeHistoryFitler();
});
notifications.addEventListener("click", () => {
    loadData("notifications");
});


function loadData(page,option = "") {
	document.title = capitalizeFirstLetter(page);
	// Set the heading name
	headingName.innerHTML = capitalizeFirstLetter(page);
	// Create a new fetch request with the selected option
	fetch(`Server/${page}.php?option=${option}`)
		.then((response) => {
			console.log("Request URL:", response.url);
			return response.text();
		})
		.then((html) => {;
			// Set the received HTML as the content of the 'dynamicContent' element
			document.querySelector(".zone-container").innerHTML = html;
		})
		.catch((error) => {
			console.error("Error:", error);
		});
    console.log(option);
}

function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function makeHistoryFitler(){
	let selectTransations = document.createElement("select");
	transactionFilter.innerHTML = "";

	let tripHistoryOption = document.createElement("option");
	tripHistoryOption.innerHTML = "Trip History";
	tripHistoryOption.setAttribute("value", "trip history");
	
	let transactionHistoryOption = document.createElement("option");
	transactionHistoryOption.innerHTML = "Transaction History";
	transactionHistoryOption.setAttribute("value", "transaction History");

	selectTransations.appendChild(transactionHistoryOption);
	selectTransations.appendChild(tripHistoryOption);

	let selectDate = document.createElement("select");
	selectDate.classList.add("l");

	let last3MonthsOption = document.createElement("option");
	last3MonthsOption.innerHTML = "Last 3 Months";
	last3MonthsOption.setAttribute("value","3 months");

	let last6MonthsOption = document.createElement("option");
	last6MonthsOption.innerHTML = "Last 6 Months";
	last6MonthsOption.setAttribute("value", "6 months");

	let year2023Option = document.createElement("option");
	year2023Option.innerHTML = "2023";
	year2023Option.setAttribute("value", "2023");

	selectDate.appendChild(last3MonthsOption);
	selectDate.appendChild(last6MonthsOption);
	selectDate.appendChild(year2023Option);

	transactionFilter.appendChild(selectTransations);
	transactionFilter.appendChild(selectDate);
	filterDate = selectDate;
	filterTransations = selectTransations;
	filterTransations.addEventListener("change", () => {
			if (filterTransations.value === "transaction History") {
				loadData("history", "transactions");
			} else {
				loadData("history", "trips");
			}
		});
}
