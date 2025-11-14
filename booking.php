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
  <link rel="stylesheet" href="booking.css">
</head>

<style>
.form-error {
  display: block;
  width: 100%;
  padding: 12px 16px;
  margin-bottom: 12px;
  border-radius: 8px;
  background: rgba(255, 0, 0, 0.12);
  color: #ff4d4d;
  border: 1px solid rgba(255, 0, 0, 0.35);
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  text-align: center;
  opacity: 1;
  transition: opacity 0.5s ease;
  position: sticky;
}

.form-error.fade-out {
  opacity: 0;
}
</style>

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
        <a href="home.php">Home</a>
        <a href="about.php">About Us</a>
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
document.addEventListener("DOMContentLoaded", () => {
  const bookingForm = document.querySelector(".booking-form");
  const eventSelect = document.getElementById("event");
  const guests = document.getElementById("guests");
  const priceField = document.getElementById("price");
  const totalField = document.getElementById("total");

  // create error banner if not exists
  let errorBanner = bookingForm.querySelector(".form-error");
  if (!errorBanner) {
    errorBanner = document.createElement("div");
    errorBanner.className = "form-error";
    errorBanner.style.display = "none";
    bookingForm.prepend(errorBanner);
  }

  // helper to show error for 4 seconds
  function showError(message) {
    errorBanner.textContent = message;
    errorBanner.style.display = "block";
    errorBanner.classList.remove("fade-out");

    bookingForm.scrollIntoView({ behavior: "smooth", block: "start" });

    if (errorBanner._timeout) clearTimeout(errorBanner._timeout);
    errorBanner._timeout = setTimeout(() => {
      errorBanner.classList.add("fade-out");
      setTimeout(() => {
        errorBanner.style.display = "none";
        errorBanner.classList.remove("fade-out");
      }, 500);
    }, 4000);
  }

  // dynamically update total
  function updateTotal() {
    const price = parseInt(priceField.value.replace(/[^\d]/g, "")) || 0;
    const count = parseInt(guests.value) || 1;
    const total = price * count;
    totalField.value = `₹${total}`;
  }

  guests.addEventListener("input", updateTotal);
  updateTotal(); // initialize on page load

  // preselect event if passed in URL
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
      const newOption = new Option(decodedEvent, decodedEvent);
      newOption.selected = true;
      eventSelect.add(newOption);
    }
  }

  bookingForm.addEventListener("submit", function (e) {
    e.preventDefault(); // stop redirect first

    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");

    let isValid = true;
    const errors = [];

    // event validation
    if (!eventSelect.value) {
      errors.push("Please select an event.");
      isValid = false;
    }

    // name validation
    if (!name.value.trim()) {
      errors.push("Full name is required.");
      isValid = false;
    }

    // email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailRegex.test(email.value.trim())) {
      errors.push("Please enter a valid email address.");
      isValid = false;
    }

    // phone validation
    const phoneValue = phone.value.trim().replace(/[\s\-().]/g, "");
    const phoneRegex = /^[6-9]\d{9}$/;
    if (!phoneRegex.test(phoneValue)) {
      errors.push("Phone number must start with 6–9 and be 10 digits.");
      isValid = false;
    }

    // guests validation
    if (!guests.value || Number(guests.value) < 1) {
      errors.push("Number of guests must be at least 1.");
      isValid = false;
    }

    if (!isValid) {
      showError(errors.join(" • "));
      return;
    }

    // ✅ all valid
    const formData = new FormData(bookingForm);
    const queryString = new URLSearchParams(formData).toString();
    window.location.href = `./payment.php?${queryString}`;
  });
});
  </script>
</body>
</html>
