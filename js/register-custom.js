// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the userType select element
    const userTypeSelect = document.getElementById('userType');
    // Get the department fields container
    const departmentFields = document.getElementById('departmentFields');
    
    // Add change event listener to userType select
    userTypeSelect.addEventListener('change', function() {
        // Show department fields if admin is selected, hide otherwise
        if (this.value === 'admin') {
            departmentFields.style.display = 'block';
            // Make department fields required
            document.getElementById('departmentName').required = true;
            document.getElementById('departmentId').required = true;
        } else {
            departmentFields.style.display = 'none';
            // Remove required attribute when fields are hidden
            document.getElementById('departmentName').required = false;
            document.getElementById('departmentId').required = false;
        }
    });
});