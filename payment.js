document.querySelector('.payment-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    const cardNumber = document.getElementById('card-number');
    const expiry = document.getElementById('expiry');
    const cvv = document.getElementById('cvv');
    const nameOnCard = document.getElementById('name-on-card');

    let isValid = true;
    let errors = [];

    // Validate Card Number
    const cardRegex = /^(\d{4} ?){4}$/;
    if (!cardNumber.value.trim() || !cardRegex.test(cardNumber.value.replace(/\s/g, ''))) {
        errors.push('Please enter a valid 16-digit card number.');
        isValid = false;
    }

    // Validate Expiry (MM/YY)
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

    // Validate CVV
    const cvvRegex = /^\d{3}$/;
    if (!cvv.value.trim() || !cvvRegex.test(cvv.value)) {
        errors.push('Please enter a valid 3-digit CVV.');
        isValid = false;
    }

    // Validate Name
    if (!nameOnCard.value.trim()) {
        errors.push('Name on card is required.');
        isValid = false;
    }

    if (!isValid) {
        alert('Please fix the following errors:\n' + errors.join('\n'));
        return;
    }

    // ✅ Simulate Successful Payment
    alert('✅ Payment Successful! Your e-ticket will download now.');

    
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const eventName = document.getElementById('event-name').value || 'Unknown Event';
    const userName = document.getElementById('user-name').value || 'Guest';
    const price = document.getElementById('event-price').value || '₹500';
    const date = new Date().toLocaleDateString();
    const time = new Date().toLocaleTimeString();
    
    
    // --- PDF TICKET DESIGN ---
    // Background Header Bar
    doc.setFillColor(25, 70, 150); // Blue shade
    doc.rect(0, 0, 210, 30, "F");

    // Header Text
    doc.setTextColor(255, 255, 255);
    doc.setFont("helvetica", "bold");
    doc.setFontSize(20);
    doc.text("🎟 JK EVENTS - E-TICKET", 60, 18);

    // Body
    doc.setTextColor(0, 0, 0);
    doc.setFontSize(14);
    doc.setFont("helvetica", "bold");
    doc.text("Event Details", 15, 45);

    doc.setFont("helvetica", "normal");
    doc.setFontSize(12);
    doc.text(`Event Name: ${eventName}`, 15, 55);
    doc.text(`Full Name: ${userName}`, 15, 65);
    doc.text(`Date of Booking: ${date}`, 15, 75);
    doc.text(`Time of Booking: ${time}`, 15, 85);
    doc.text(`Amount Paid: ${price}`, 15, 95);
    doc.text(`Payment Status: PAID ✅`, 15, 105);

    // Footer Line
    doc.setFontSize(10);
    doc.setTextColor(100, 100, 100);
    doc.text("Thank you for booking with JK Events. Present this ticket at entry.", 15, 130);
    doc.text("This is a system-generated ticket, no signature required.", 15, 135);

    // --- Save Ticket ---
    doc.save(`${eventName}_E-Ticket.pdf`);
    window.location.href = "/.bookinginfo.php";
    // Redirect after short delay
    setTimeout(() => {
        window.location.href = "./home.php";
    }, 2000);
});
