document.addEventListener("DOMContentLoaded", () => {
    const bookingForm = document.querySelector(".booking-form");
    const eventSelect = document.getElementById("event");

    const urlParams = new URLSearchParams(window.location.search);
    const eventFromUrl = urlParams.get("event");
    if (eventFromUrl) {
        const decodedEvent = decodeURIComponent(eventFromUrl);
        let found = false;

        for (const option of eventSelect.options) {
            if (option.text.toLowerCase() === decodedEvent.toLowerCase()) {
                option.selected = true;
                found = true;
                break;
            }
        }
        if (!found) {
            const newOption = new Option(decodedEvent, decodedEvent.toLowerCase().replace(/\s+/g, '-'));
            newOption.selected = true;
            eventSelect.add(newOption);
        }
    }
    bookingForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const name = document.getElementById("name");
        const email = document.getElementById("email");
        const phone = document.getElementById("phone");
        const date = document.getElementById("date");
        const guests = document.getElementById("guests");

        let isValid = true;
        const errors = [];

        if (!eventSelect.value) {
            errors.push("Please select an event.");
            isValid = false;
        }

        if (!name.value.trim()) {
            errors.push("Full name is required.");
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim() || !emailRegex.test(email.value)) {
            errors.push("Please enter a valid email address.");
            isValid = false;
        }

        const phoneRegex = /^\d{10,15}$/;
        if (!phone.value.trim() || !phoneRegex.test(phone.value)) {
            errors.push("Please enter a valid phone number (10-15 digits).");
            isValid = false;
        }


        if (!guests.value || guests.value < 1) {
            errors.push("Number of guests must be at least 1.");
            isValid = false;
        }

        if (!isValid) {
            alert("Please fix the following errors:\n\n" + errors.join("\n"));
            return;
        }

        const formData = new FormData(event.target);
        const queryString = new URLSearchParams(formData).toString();
        window.location.href = `./payment.php?${queryString}`;
    });
});
