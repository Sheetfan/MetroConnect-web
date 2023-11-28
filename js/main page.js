const dashboard = document.querySelector("#dashboard");
const historyPage = document.querySelector("#history");
const notifications = document.querySelector("#notifications");
const headingName = document.querySelector(".heading-name");
const transactionFilter = document.querySelector(".transaction-filters");

let filterDate = null;
let filterTransations = null;

let comboBoxSelect1;
let comboBoxSelect2;

const transValue = ["transactions", "trips"];
let dateValue = ["none", "3 months", "6 months"];

window.addEventListener("DOMContentLoaded",() => {
	loadData("dashboard");
});
dashboard.addEventListener("click", () => {
	filterDate.remove();
	filterTransations.remove();
	filterDate = null;
	filterTransations = null;
	loadData("dashboard");
});
historyPage.addEventListener("click", () => {
	comboBoxSelect1 = transValue[0];
	comboBoxSelect2 = dateValue[0];
	filterDate = null;
	filterTransations = null;
    loadData("history", comboBoxSelect1,comboBoxSelect2);
	makeHistoryFitler();
});
notifications.addEventListener("click", () => {
	filterDate.remove();
	filterTransations.remove();
	filterDate = null;
	filterTransations = null;
    loadData("notifications");
});

function loadData(page, option1 = "", option2 = "") {
	document.title = capitalizeFirstLetter(page);
	// Set the heading name
	headingName.innerHTML = capitalizeFirstLetter(page);
	// Create a new fetch request with the selected option

	fetch(`Server/${page}.php?option1=${option1}&option2=${option2}`)
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
}

function generateDateCombobox(option1){
	if(filterDate === null){
			filterDate = document.createElement("select");
			filterDate.classList.add("l");			
	}
	else{

		filterDate.children.array.forEach(element => {
			element.remove();
		});
	}
		let noneOption = document.createElement("option");
		noneOption.innerHTML = "None";
		noneOption.setAttribute("value", dateValue[0]);

		let last3MonthsOption = document.createElement("option");
		last3MonthsOption.innerHTML = "Last 3 Months";
		last3MonthsOption.setAttribute("value", dateValue[1]);

		let last6MonthsOption = document.createElement("option");
		last6MonthsOption.innerHTML = "Last 6 Months";
		last6MonthsOption.setAttribute("value", dateValue[2]);

		filterDate.appendChild(noneOption);
		filterDate.appendChild(last3MonthsOption);
		filterDate.appendChild(last6MonthsOption);
	
	fetch(`Server/dateComboBox.php?option=${option1}`)
		.then((response) => {
			console.log("Request URL:", response.url);
			console.log(response);
			return response.json();
		})
		.then((years) => {
			for (let i = 0; i < years.length; i++) {
				let yearOption = document.createElement("option");
				yearOption.innerHTML = years[i];
				yearOption.setAttribute("value", `${years[i]}`);
				dateValue.push(years[i]);

				filterDate.appendChild(yearOption);
				transactionFilter.appendChild(filterDate);
			}
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}

function generateTransactionCombobox() {
	filterTransations = document.createElement("select");

	let tripHistoryOption = document.createElement("option");
	tripHistoryOption.innerHTML = "Trip History";
	tripHistoryOption.setAttribute("value", transValue[1]);

	let transactionHistoryOption = document.createElement("option");
	transactionHistoryOption.innerHTML = "Transaction History";
	transactionHistoryOption.setAttribute("value", transValue[0]);

	filterTransations.appendChild(transactionHistoryOption);
	filterTransations.appendChild(tripHistoryOption);

	transactionFilter.appendChild(filterTransations);
}
	
function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function makeHistoryFitler(){
	transactionFilter.innerHTML = "";

	generateTransactionCombobox();
	generateDateCombobox(comboBoxSelect1);
	filterTransations.addEventListener("change", () => {
		comboBoxSelect1 = filterTransations.value;
		comboBoxSelect2 = dateValue[0];
		loadData("history",comboBoxSelect1,comboBoxSelect2);
		generateDateCombobox(comboBoxSelect1);
	});
	filterDate.addEventListener("change", () =>{
		comboBoxSelect1 = filterTransations.value;
		comboBoxSelect2 = filterDate.value;
		loadData("history", comboBoxSelect1, comboBoxSelect2);
		//generateDateCombobox(comboBoxSelect1);
	});
}