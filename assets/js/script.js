// Client-side form validation
document.addEventListener('DOMContentLoaded', function() {
    // Phone number input - allow only digits and limit to 11
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Remove any non-digit characters
            let value = e.target.value.replace(/\D/g, '');
            // Limit to 11 digits
            e.target.value = value.substring(0, 11);
        });

        // Validate on form submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const phoneValue = phoneInput.value.replace(/\D/g, '');
                if (phoneValue.length !== 11) {
                    e.preventDefault();
                    alert('Please enter exactly 11-digit phone number');
                }
            });
        }
    }

    // Bottle count form submission confirmation
    const bottleForm = document.querySelector('.dashboard-page form');
    if (bottleForm) {
        bottleForm.addEventListener('submit', function(e) {
            const bottleCount = parseInt(document.getElementById('bottle_count').value);
            if (isNaN(bottleCount) || bottleCount < 1) {
                e.preventDefault();
                alert('Please enter a valid number of bottles (at least 1)');
            }
        });
    }
});