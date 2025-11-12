<?php include 'navbar.php'; ?>

<?php
$selectedEvent = isset($_GET['event']) ? htmlspecialchars($_GET['event']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book your events seamlessly with JK Events.">
    <meta name="keywords" content="Event, Booking, Environment">
    <meta name="robots" content="FOLLOW, INDEX">
    <title>Book an Event - JK Events</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="booking.css">
</head>

<body>
    <div class="booking-section">
        <h1>Book an Event</h1>
        <p>Fill in the details below to reserve your spot at one of our events.</p>

        <form class="booking-form" id="booking-form" method="get" action="./payment.php">
            <label for="event">Select Event:</label>
            <select id="event" name="event" required>
                <?php if ($selectedEvent): ?>
                    <option value="<?php echo $selectedEvent; ?>" selected><?php echo $selectedEvent; ?></option>
                <?php else: ?>
                    <option value="">Choose an event</option>
                <?php endif; ?>

                <option value="Cultural Festival">Cultural Festival</option>
                <option value="Community Gathering">Community Gathering</option>
                <option value="Eco-Friendly Event">Eco-Friendly Event</option>
                <option value="Rooftop Party">Rooftop Party</option>
                <option value="Live Jazz Night">Live Jazz Night</option>
                <option value="Dance Marathon">Dance Marathon</option>
                <option value="Gourmet Food Truck Festival">Gourmet Food Truck Festival</option>
                <option value="Midnight Movie Screening">Midnight Movie Screening</option>
            </select>

            <!-- Full Name -->
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>

            <!-- Phone -->
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="10-digit number" required>

            <!-- Guests -->
            <label for="guests">Number of Guests:</label>
            <input type="number" id="guests" name="guests" min="1" value="1" required>

            <!-- Ticket Price (Per Person) -->
            <label for="price">Ticket Price (per guest):</label>
            <input type="text" id="price" name="price" value="₹500" readonly>

            <!-- Total Amount -->
            <label for="total">Total Amount:</label>
            <input type="text" id="total" name="total" value="₹500" readonly>

            <!-- Submit Button -->
            <button type="submit" class="book-btn">Proceed to Payment</button>
        </form>
    </div>

    <footer>
        <div class="top">
            <div class="links">
                <h5>Useful Links:</h5>
                <a href="../About/about.html">About Us</a>
                <a href="#">Events</a>
                <a href="#">Contact Us</a>
            </div>
            <div class="reach">
                <h5>More About Us:</h5>
                <a href="https://github.com/Koushik-Sharma" target="_blank">GitHub</a>
                <a href="mailto:johnpaulfernandes18@gmail.com">Gmail</a>
            </div>
        </div>

        <div class="copyright">
            <h5>&copy; 2025 JK Events Goa. All Rights Reserved</h5>
        </div>
    </footer>

    <script>
    const guestInput = document.getElementById('guests');
    const priceInput = document.getElementById('price');
    const totalInput = document.getElementById('total');
    const bookingForm = document.getElementById('booking-form');

    const basePrice = 500;

    guestInput.addEventListener('input', () => {
        let guests = parseInt(guestInput.value) || 1;
        let total = basePrice * guests;
        totalInput.value = `₹${total}`;
    });

    bookingForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const selectedEvent = document.getElementById('event').value;
        const fullName = document.getElementById('name').value.trim();
        const totalAmount = totalInput.value.trim();

        if (!selectedEvent || !fullName) {
            alert("Please fill in all required fields.");
            return;
        }

        const params = new URLSearchParams({
            event: selectedEvent,
            name: fullName,
            price: totalAmount
        });
        window.location.href = "./payment.php?" + params.toString();
    });
    </script>
</body>
</html>
