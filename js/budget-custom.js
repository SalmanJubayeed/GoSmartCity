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
