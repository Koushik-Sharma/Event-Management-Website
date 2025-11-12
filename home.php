<!-- Home Page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="discription" content="Be aware and book the events listed now sleamlessly using our platform.">
    <meta name="keywords" content="Event, Environment, Bookings">
    <meta name="robots" content="FOLLOW, INDEX">

    <title>Event Management</title>

    <link rel="stylesheet" href="./style.css">
</head>

<body>
<?php include 'navbar.php'; ?>
    <!-- Title -->
    <div class="highlight">
        <div class="icon">
            <img src="./images/Highlight.png" alt="Image" id="Highlight_icon">
        </div>

        <div class="info">
            <div class="text">
                <h1>JK Events</h1>

                <h4 id="tagline">From concept to celebration—your complete solution for flawless event management.</h4>
            </div>

            <div class="action">
                <button>View Events</button>
                <button>Book an Event</button>
            </div>
        </div>
    </div>

    <!-- Aim -->
    <div class="aim">
        <h3>Our AIM</h3>

        <hr>

        <p>At JK Events, our mission is to transform the way people discover, engage with events—while putting sustainability at the heart of every experience. We aim to raise awareness about diverse events happening around you—from cultural festivals to community gatherings—so no moment goes unnoticed. Champion environmental consciousness by spotlighting eco-friendly events and encouraging sustainable practices in event planning.Simplify the booking process with intuitive tools that make attending or hosting events effortless, accessible, and stress-free. Whether you're an organizer looking to make an impact or an attendee seeking meaningful experiences, we’re here to connect you with events that matter—to you and to the planet.</p>
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

        <div class="more">
            <div class="circle"></div>
            <div class="circle" id="filled"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
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
                <a href="johnpaulfernandes18@gmail.com" target="_blank">Gmail</a>
            </div>
        </div>

        <div class="copyright">
            <h5>&copy; 2025 JK Events Goa. All Rights Reserved</h5>
        </div>
    </footer>

    <script src="./index.js"></script>
</body>
</html>