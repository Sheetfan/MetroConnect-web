const dashboard = document.querySelector(".dashboard");
const historyPage = document.querySelector(".history");
const notifications = document.querySelector(".notifications");
const headingName = document.querySelector(".heading-name");
const topCompontents = document.querySelector(".top-compontents");


let filterDate = document.createElement("select");
let filterTransations = document.createElement("select");
let filterDateN = document.createElement("select");

let comboBoxSelect1;
let comboBoxSelect2;

const transValue = ["transactions", "trips", "notifications"];
let dateValue = ["none", "3 months", "6 months"];

window.addEventListener("DOMContentLoaded",() => {
	loadData("dashboard");
});
dashboard.addEventListener("click", () => {
	filterDate.remove();
	filterTransations.remove();
	filterDateN.remove();
	loadData("dashboard");
});

historyPage.addEventListener("click", () => {
	comboBoxSelect1 = transValue[0];
	comboBoxSelect2 = dateValue[0];
    loadData("history", comboBoxSelect1,comboBoxSelect2);
	makeHistoryFitler();
});
notifications.addEventListener("click", () => {
	filterDate.remove();
	filterTransations.remove();
	comboBoxSelect1 = transValue[2];
    loadData("notifications", comboBoxSelect1);
	makeNotifcationsFilter();
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
			document.querySelector(".main-container").innerHTML = html;
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}

function generateDateCombobox(option1,comboBox){
		if (comboBox.children.length > 0) {
			while (0 < comboBox.children.length) {
				comboBox.children[0].remove();
			}
		}

		comboBox.classList.add("history-comboxbox");
		let noneOption = document.createElement("option");
		noneOption.innerHTML = "None";
		noneOption.setAttribute("value", dateValue[0]);

		let last3MonthsOption = document.createElement("option");
		last3MonthsOption.innerHTML = "Last 3 Months";
		last3MonthsOption.setAttribute("value", dateValue[1]);

		let last6MonthsOption = document.createElement("option");
		last6MonthsOption.innerHTML = "Last 6 Months";
		last6MonthsOption.setAttribute("value", dateValue[2]);

		comboBox.appendChild(noneOption);
		comboBox.appendChild(last3MonthsOption);
		comboBox.appendChild(last6MonthsOption);
	
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
				comboBox.appendChild(yearOption);
				topCompontents.appendChild(comboBox);
			}
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}

function generateTransactionCombobox() {
	if (filterTransations.children.length > 0) {
		while (0 < filterTransations.children.length) {
			filterTransations.children[0].remove();
		}
	}
	filterTransations.classList.add("history-comboxbox");
	let tripHistoryOption = document.createElement("option");
	tripHistoryOption.innerHTML = "Trip History";
	tripHistoryOption.setAttribute("value", transValue[1]);

	let transactionHistoryOption = document.createElement("option");
	transactionHistoryOption.innerHTML = "Transaction History";
	transactionHistoryOption.setAttribute("value", transValue[0]);

	filterTransations.appendChild(transactionHistoryOption);
	filterTransations.appendChild(tripHistoryOption);

	topCompontents.appendChild(filterTransations);
}
	
function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function makeHistoryFitler(){
	topCompontents.innerHTML = "";

	generateTransactionCombobox();
	generateDateCombobox(comboBoxSelect1, filterDate);
	topCompontents.classList.add("top-compontents-history");
	filterTransations.addEventListener("change", () => {
		comboBoxSelect1 = filterTransations.value;
		comboBoxSelect2 = dateValue[0];
		loadData("history",comboBoxSelect1,comboBoxSelect2);
		generateDateCombobox(comboBoxSelect1,filterDate);
	});
	filterDate.addEventListener("change", () =>{
		comboBoxSelect1 = filterTransations.value;
		comboBoxSelect2 = filterDate.value;
		loadData("history", comboBoxSelect1, comboBoxSelect2);
	});
}
function makeNotifcationsFilter(){
	generateDateCombobox(comboBoxSelect1,filterDateN);
	topCompontents.classList.add("top-compontents-notifications");
	filterDateN.addEventListener("change",() => {
		comboBoxSelect1 = filterDateN.value;
		loadData("notifications", comboBoxSelect1);
	});
}