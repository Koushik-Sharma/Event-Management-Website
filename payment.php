<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complete your payment for JK Events booking.">
    <meta name="keywords" content="Event, Payment, Booking">
    <meta name="robots" content="FOLLOW, INDEX">
    <title>Payment - JK Events</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="payment.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <?php
        // Get booking details from previous page (GET parameters)
        $event = isset($_GET['event']) ? htmlspecialchars($_GET['event']) : 'Unknown Event';
        $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Guest';
        $price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '₹500';
    ?>

    <!-- Payment Section -->
    <div class="payment-section">
        <h1>Complete Your Payment</h1>
        <p>Securely enter your payment details to confirm your booking.</p>

        <!-- Booking Summary -->
        <div class="booking-summary">
            <h3>Booking Summary</h3>
            <p><strong>Event:</strong> <?php echo $event; ?></p>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Total Amount:</strong> <?php echo $price; ?></p>
        </div>

        <form class="payment-form" action="#" method="post">
            <!-- Hidden inputs to pass to JS -->
            <input type="hidden" id="event-name" value="<?php echo $event; ?>">
            <input type="hidden" id="user-name" value="<?php echo $name; ?>">
            <input type="hidden" id="event-price" value="<?php echo $price; ?>">

            <!-- Card Number -->
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>

            <!-- Expiry -->
            <label for="expiry">Expiry Date:</label>
            <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>

            <!-- CVV -->
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>

            <!-- Name -->
            <label for="name-on-card">Name on Card:</label>
            <input type="text" id="name-on-card" name="name-on-card" required>

            <button type="submit" class="pay-btn">Pay Now</button>
        </form>

        <a href="./home.php" class="home-btn">Home</a>
    </div>

    <!-- Footer -->
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

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="./payment.js"></script>
</body>
</html>
