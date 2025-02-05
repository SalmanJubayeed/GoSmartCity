// Register page
document.addEventListener('DOMContentLoaded', function() {
    const userTypeSelect = document.getElementById('userType');
    if (userTypeSelect) {
        userTypeSelect.addEventListener('change', function() {
            const adminSection = document.getElementById('adminVerification');
            if (this.value === 'admin') {
                adminSection.style.display = 'block';
            } else {
                adminSection.style.display = 'none';
            }
        });
    }
});