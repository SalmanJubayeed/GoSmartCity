// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


// client section owl carousel
$(".client_owl-carousel").owlCarousel({
    loop: true,
    margin: 20,
    dots: false,
    nav: true,
    navText: [],
    autoplay: true,
    autoplayHoverPause: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});



/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

// Traffic Chart
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('trafficChart').getContext('2d');
    var trafficChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['6 AM', '9 AM', '12 PM', '3 PM', '6 PM', '9 PM'],
            datasets: [{
                label: 'Main Route',
                data: [20, 80, 50, 45, 85, 30],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }, {
                label: 'Alternate Route',
                data: [10, 40, 30, 25, 45, 15],
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Traffic Density (%)'
                    }
                }
            }
        }
    });
});

// Traffic Map

// Initialize the map centered at Chattogram
var map = L.map('trafficMap').setView([22.3569, 91.7832], 12); // Chattogram center
    
// Add OpenStreetMap tile layer (Free and no API key required)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Add a marker at the center of Chattogram
var chattogramCenter = L.marker([22.3569, 91.7832]).addTo(map)
  .bindPopup("<b>Chattogram</b><br>The port city of Bangladesh.");

// Fetch real-time traffic data from a free API (Replace with actual free traffic API)
async function fetchTrafficData() {
    try {
        let response = await fetch("https://api.example.com/traffic"); // Replace with a real traffic API
        let data = await response.json();

        // Loop through traffic data and add markers for traffic updates
        data.forEach(point => {
            L.marker([point.lat, point.lon])
                .addTo(map)
                .bindPopup(`<b>${point.status}</b><br>${point.description}`);
        });
    } catch (error) {
        console.error("Error fetching traffic data:", error);
    }
}

fetchTrafficData(); // Call function to fetch traffic updates

// Service Navbar dropdown menu
document.addEventListener("DOMContentLoaded", function () {
    var dropdown = document.querySelector(".nav-item.dropdown");
    dropdown.addEventListener("mouseenter", function () {
      this.querySelector(".dropdown-menu").classList.add("show");
    });
    dropdown.addEventListener("mouseleave", function () {
      this.querySelector(".dropdown-menu").classList.remove("show");
    });
  });
  

// Budget Tracker
document.addEventListener('DOMContentLoaded', function() {
    const incomeForm = document.querySelector('.income_form');
    const expenseForm = document.querySelector('.expense_form');
    const calculateButton = document.querySelector('.calculate_budget_btn');

    // Income inputs
    const primaryIncomeInput = incomeForm.querySelector('input[placeholder="Enter primary income"]');
    const additionalIncomeInput = incomeForm.querySelector('input[placeholder="Freelance, investments, etc."]');
    const totalIncomeDisplay = incomeForm.querySelector('input[readonly]');

    // Expense inputs
    const expenseCategoryInputs = expenseForm.querySelectorAll('input[type="number"]');

    // Summary displays
    const totalIncomeElement = document.querySelector('.total_income .amount');
    const totalExpensesElement = document.querySelector('.total_expenses .amount');
    const budgetBalanceElement = document.querySelector('.budget_balance .amount');
    const balanceAdviceElement = document.querySelector('.balance_advice p');

    function calculateTotalIncome() {
        const primaryIncome = parseFloat(primaryIncomeInput.value) || 0;
        const additionalIncome = parseFloat(additionalIncomeInput.value) || 0;
        const totalIncome = primaryIncome + additionalIncome;
        
        totalIncomeInput.value = totalIncome.toFixed(2);
        return totalIncome;
    }

    function calculateTotalExpenses() {
        let totalExpenses = 0;
        expenseCategoryInputs.forEach(input => {
            totalExpenses += parseFloat(input.value) || 0;
        });
        return totalExpenses;
    }

    function provideFinancialAdvice(income, expenses) {
        const savingsRate = ((income - expenses) / income) * 100;
        
        if (savingsRate > 30) {
            return "Excellent! You're saving more than 30% of your income. Consider investing the surplus.";
        } else if (savingsRate > 20) {
            return "Good job! You're maintaining a healthy savings rate. Consider further optimizing expenses.";
        } else if (savingsRate > 10) {
            return "You're saving, but could improve. Look for areas to reduce expenses or increase income.";
        } else if (savingsRate > 0) {
            return "Minimal savings. Review your expenses carefully and look for significant cost-cutting opportunities.";
        } else {
            return "Warning: Your expenses exceed your income. Urgent budget restructuring needed.";
        }
    }

    calculateButton.addEventListener('click', function(e) {
        e.preventDefault();

        const totalIncome = calculateTotalIncome();
        const totalExpenses = calculateTotalExpenses();
        const budgetBalance = totalIncome - totalExpenses;

        // Update summary displays
        totalIncomeElement.textContent = `৳ ${totalIncome.toFixed(2)}`;
        totalExpensesElement.textContent = `৳ ${totalExpenses.toFixed(2)}`;
        budgetBalanceElement.textContent = `৳ ${budgetBalance.toFixed(2)}`;

        // Provide financial advice
        const advice = provideFinancialAdvice(totalIncome, totalExpenses);
        balanceAdviceElement.textContent = advice;
    });
});