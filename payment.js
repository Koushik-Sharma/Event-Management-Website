document.querySelector('.payment-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const cardNumber = document.getElementById('card-number');
    const expiry = document.getElementById('expiry');
    const cvv = document.getElementById('cvv');
    const nameOnCard = document.getElementById('name-on-card');

    let isValid = true;
    let errors = [];

    const cardRegex = /^(\d{4} ?){4}$/;
    if (!cardNumber.value.trim() || !cardRegex.test(cardNumber.value.replace(/\s/g, ''))) {
        errors.push('Please enter a valid 16-digit card number.');
        isValid = false;}
    
    const expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
    if (!expiry.value.trim() || !expiryRegex.test(expiry.value)) {
        errors.push('Please enter a valid expiry date (MM/YY).');
        isValid = false;
    } else {
        const [month, year] = expiry.value.split('/');
        const currentDate = new Date();
        const expiryDate = new Date(`20${year}`, month - 1);
        if (expiryDate <= currentDate) {
            errors.push('Expiry date must be in the future.');
            isValid = false;
        }
    }

    const cvvRegex = /^\d{3}$/;
    if (!cvv.value.trim() || !cvvRegex.test(cvv.value)) {
        errors.push('Please enter a valid 3-digit CVV.');
        isValid = false;
    }

    if (!nameOnCard.value.trim()) {
        errors.push('Name on card is required.');
        isValid = false;
    }

    if (!isValid) {
        alert('Please fix the following errors:\n' + errors.join('\n'));
    } else {
        alert('Payment successful! (Demo - no real transaction)');
        window.location.href = './index.html';
    }
});

document.querySelector('.payment-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default submission

    const cardNumber = document.getElementById('card-number');
    const expiry = document.getElementById('expiry');
    const cvv = document.getElementById('cvv');
    const nameOnCard = document.getElementById('name-on-card');

    let isValid = true;
    let errors = [];

    // Validate card number (16 digits, spaces allowed)
    const cardRegex = /^(\d{4} ?){4}$/;
    if (!cardNumber.value.trim() || !cardRegex.test(cardNumber.value.replace(/\s/g, ''))) {
        errors.push('Please enter a valid 16-digit card number.');
        isValid = false;
    }

    // Validate expiry (MM/YY, future date)
    const expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
    if (!expiry.value.trim() || !expiryRegex.test(expiry.value)) {
        errors.push('Please enter a valid expiry date (MM/YY).');
        isValid = false;
    } else {
        const [month, year] = expiry.value.split('/');
        const currentDate = new Date();
        const expiryDate = new Date(`20${year}`, month - 1);
        if (expiryDate <= currentDate) {
            errors.push('Expiry date must be in the future.');
            isValid = false;
        }
    }

    // Validate CVV (3 digits)
    const cvvRegex = /^\d{3}$/;
    if (!cvv.value.trim() || !cvvRegex.test(cvv.value)) {
        errors.push('Please enter a valid 3-digit CVV.');
        isValid = false;
    }

    // Validate name on card
    if (!nameOnCard.value.trim()) {
        errors.push('Name on card is required.');
        isValid = false;
    }

    // Show errors or submit
    if (!isValid) {
        alert('Please fix the following errors:\n' + errors.join('\n'));
    } else {
        alert('Payment successful! (Demo - no real transaction)');
        // In real app, process payment here and redirect
        window.location.href = './index.html'; // Redirect to home after success
    }
});