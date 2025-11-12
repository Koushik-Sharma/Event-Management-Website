<?php
include 'connect_db.php';

// Fetch events from database
$events = [];
$sql = "SELECT name, venue, date, time FROM events";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Be aware and book the events listed now seamlessly using our platform.">
  <meta name="keywords" content="Event, Environment, Bookings">
  <meta name="robots" content="FOLLOW, INDEX">
  <title>Event Management</title>
  <link rel="stylesheet" href="./style.css" />
</head>

<body>
  <?php include 'navbar.php'; ?>

  <div class="content">
    <!-- Hero -->
    <div class="highlight">
      <div class="icon">
        <img src="./images/Highlight.png" alt="Highlight Icon" id="Highlight_icon">
      </div>
      <div class="info">
        <div class="text">
          <h1>JK Events</h1>
          <h4 id="tagline">From concept to celebration—your complete solution for flawless event management.</h4>
        </div>
        <div class="action">
          <button id="viewEventsBtn">View Events</button>
        </div>
      </div>
    </div>

    <!-- Aim -->
    <div class="aim">
      <h3>Our AIM</h3>
      <hr>
      <p>At JK Events, our mission is to transform the way people discover and engage with events—while putting sustainability at the heart of every experience. We connect you with meaningful experiences that matter to you and to the planet.</p>
    </div>

    <!-- Events -->
    <div class="events_overview">
      <h3>Events</h3>
      <hr>
      <div class="card">
        <div class="event_pic">
          <img alt="Event" id="Event_icon">
        </div>
        <div class="info">
          <h4 id="event_title"></h4>
          <p id="firstpara"></p>
          <p id="secondpara"></p>
          <p id="thirdpara"></p>
          <h6 id="location"></h6>
        </div>
      </div>
      <div class="more"></div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="top">
      <div class="links">
        <h5>Useful Links:</h5>
        <a href="about.php">About Us</a>
        <a href="event.php">Events</a>
      </div>
      <div class="reach">
        <h5>More About Us:</h5>
        <a href="https://github.com/Koushik-Sharma" target="_blank">GitHub</a>
        <a href="mailto:johnpaulfernandes18@gmail.com" target="_blank">Gmail</a>
      </div>
    </div>
    <div class="copyright">
      <h5>&copy; 2025 JK Events Goa. All Rights Reserved</h5>
    </div>
  </footer>

  <!-- Inject DB events into JS -->
  <script>
    const events = <?php echo json_encode($events, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
  </script>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    // Animation
    const animatedElements = document.querySelectorAll(".highlight, .aim, .events_overview, .card");
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate");
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    animatedElements.forEach((el) => {
      el.classList.add("pre-animate");
      observer.observe(el);
    });

    // View Events button
    document.getElementById("viewEventsBtn").addEventListener("click", () => {
      window.location.href = "event.php";
    });

    // Check if DB has events
    if (!events || events.length === 0) {
      const card = document.querySelector(".card");
      card.querySelector("h4").textContent = "No events available right now.";
      return;
    }

    const card = document.querySelector(".card");
    const circlesContainer = document.querySelector(".more");
    circlesContainer.innerHTML = "";

    // Local image paths array (adjust these file names to match your actual images)
    const eventImages = [
      "./images/Event1.jpg",
      "./images/Event2.png",
      "./images/Event3.png",
      "./images/Event4.png",
    ];

    // Create circle indicators
    events.forEach(() => {
      const circle = document.createElement("div");
      circle.classList.add("circle");
      circlesContainer.appendChild(circle);
    });

    const circles = document.querySelectorAll(".circle");
    let currentIndex = 0;
    let interval;

    // Function to update card
    function updateCard(index) {
      const event = events[index];
      const imagePath = eventImages[index % eventImages.length]; // rotate through image array

      card.classList.remove("active");
      card.classList.add("slide-out");

      setTimeout(() => {
        card.querySelector("h4").textContent = event.name;
        card.querySelector("#Event_icon").src = imagePath;
        const ps = card.querySelectorAll("p");
        ps[0].textContent = `Date: ${event.date}`;
        ps[1].textContent = `Time: ${event.time}`;
        ps[2].textContent = "Experience this amazing event organized by JK Events.";
        card.querySelector("h6").textContent = `Venue: ${event.venue}`;

        card.classList.remove("slide-out");
        card.classList.add("slide-in");
        setTimeout(() => {
          card.classList.remove("slide-in");
          card.classList.add("active");
        }, 600);
      }, 400);

      circles.forEach((c, i) => (c.id = i === index ? "filled" : ""));
      currentIndex = index;
    }

    // Auto-rotate carousel
    function autoRotate() {
      interval = setInterval(() => {
        updateCard((currentIndex + 1) % events.length);
      }, 5000);
    }

    // Circle click navigation
    circles.forEach((circle, index) => {
      circle.addEventListener("click", () => {
        clearInterval(interval);
        updateCard(index);
        autoRotate();
      });
    });

    // Initialize
    updateCard(0);
    autoRotate();
  });
  </script>
</body>
</html>
