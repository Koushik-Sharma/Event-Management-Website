document.querySelector('.booking-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const eventSelect = document.getElementById('event');
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const date = document.getElementById('date');
    const guests = document.getElementById('guests');

    let isValid = true;
    let errors = [];

    if (!eventSelect.value) {
        errors.push('Please select an event.');
        isValid = false;
    }

    if (!name.value.trim()) {
        errors.push('Full name is required.');
        isValid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailRegex.test(email.value)) {
        errors.push('Please enter a valid email address.');
        isValid = false;
    }

    const phoneRegex = /^\d{10,15}$/;
    if (!phone.value.trim() || !phoneRegex.test(phone.value)) {
        errors.push('Please enter a valid phone number (10-15 digits).');
        isValid = false;
    }

    const today = new Date().toISOString().split('T')[0];
    if (!date.value || date.value < today) {
        errors.push('Please select a valid future date.');
        isValid = false;
    }

    if (!guests.value || guests.value < 1) {
        errors.push('Number of guests must be at least 1.');
        isValid = false;
    }

    if (!isValid) {
        alert('Please fix the following errors:\n' + errors.join('\n'));
    } else {
        const formData = new FormData(event.target);
        const queryString = new URLSearchParams(formData).toString();
        window.location.href = `./payment.html?${queryString}`;
    }
});