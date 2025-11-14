document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("paymentForm");

    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // Stop reload

        const card = form.querySelector("#card-number").value.trim();
        const expiry = form.querySelector("#expiry").value.trim();
        const cvv = form.querySelector("#cvv").value.trim();
        const nameCard = form.querySelector("#name-on-card").value.trim();
        const eventName = form.querySelector("input[name='event']").value;
        const userName = form.querySelector("input[name='name']").value;
        const price = form.querySelector("input[name='price']").value;

        // ✅ Validation rules
        const cardRegex = /^\d{16}$/; // 16 digits only
        const cvvRegex = /^\d{3}$/; // 3 digits only
        const expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/; // MM/YY
        const nameRegex = /^[A-Za-z\s]{3,}$/; // letters & spaces

        // ✅ Validate Card Number
        if (!cardRegex.test(card)) {
            alert("⚠️ Invalid card number. It must be exactly 16 digits.");
            return;
        }

        // ✅ Validate Expiry Date
        if (!expiryRegex.test(expiry)) {
            alert("⚠️ Invalid expiry format. Use MM/YY format.");
            return;
        } else {
            const [month, year] = expiry.split("/").map(Number);
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth() + 1;
            const currentYear = Number(currentDate.getFullYear().toString().slice(-2));

            // Expiry check
            if (year < currentYear || (year === currentYear && month < currentMonth)) {
                alert("⚠️ This card is expired. Please use a valid card.");
                return;
            }
        }

        // ✅ Validate CVV
        if (!cvvRegex.test(cvv)) {
            alert("⚠️ CVV must be exactly 3 digits.");
            return;
        }

        // ✅ Validate Name on Card
        if (!nameRegex.test(nameCard)) {
            alert("⚠️ Name on card must contain only letters and spaces (min 3 characters).");
            return;
        }

        // ✅ Proceed with booking insertion
        try {
            const response = await fetch("insert_booking.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({ event: eventName, name: userName, price }),
            });

            const result = await response.json();

            if (result.status === "success") {
                alert("✅ Payment successful! Ticket will now download.");
                generateTicketPDF(eventName, userName, price);
            } else {
                alert("❌ Error: " + result.message);
            }
        } catch (err) {
            alert("⚠️ Network error: " + err.message);
        }
    });
});

function generateTicketPDF(event, name, price) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(22);
    doc.text("🎟 JK Events Ticket", 20, 25);
    doc.setFontSize(14);
    doc.text(`Event: ${event}`, 20, 45);
    doc.text(`Name: ${name}`, 20, 55);
    doc.text(`Amount Paid: ${price}`, 20, 65);
    doc.text(`Date: ${new Date().toLocaleString()}`, 20, 75);
    doc.text("✅ Booking Confirmed!", 20, 90);

    doc.save(`Ticket_${event.replace(/\s+/g, "_")}.pdf`);
}
