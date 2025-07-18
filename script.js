document.getElementById('tripForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const tripName = document.getElementById('tripName').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const budget = document.getElementById('budget').value;
    
    // Functionality to save trip data to the server can be implemented here
    console.log(`Trip Created: ${tripName}, Start: ${startDate}, End: ${endDate}, Budget: ${budget}`);
});

document.getElementById('currencyForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const amount = document.getElementById('amount').value;
    const currencyFrom = document.getElementById('currencyFrom').value;
    const currencyTo = document.getElementById('currencyTo').value;
    
    // Functionality for currency conversion