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




// Withdrawal Modal Functions
function openWithdrawModal() {
    document.getElementById('withdrawModal').style.display = 'block';
}

function closeWithdrawModal() {
    document.getElementById('withdrawModal').style.display = 'none';
}

function submitWithdraw() {
    // Create the form if it doesn't exist (fallback)
    let form = document.getElementById('withdrawForm');
    if (!form) {
        form = document.createElement('form');
        form.id = 'withdrawForm';
        form.method = 'POST';
        form.style.display = 'none';
        
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'withdraw';
        input.value = '1';
        
        form.appendChild(input);
        document.body.appendChild(form);
    }
    
    form.submit();
}

// Initialize modal events
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('withdrawModal');
    const cancelBtn = document.querySelector('#withdrawModal .cancel-btn');
    
    // Close when clicking outside modal
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeWithdrawModal();
        }
    });
    
    // Close when clicking cancel
    cancelBtn.addEventListener('click', closeWithdrawModal);
    
    // Close when pressing ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeWithdrawModal();
        }
    });
});


