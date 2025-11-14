<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to access the event page.');</script>";
    header("Location: /webtech_project/login.php");
    exit();
}?>

<!DOCTYPE html>
<html>
    <head>
        <title> EVENT PAGE </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@400..700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">   
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel = "stylesheet" href = "event_style.css">
    </head>
    <body>
 <?php include 'navbar.php'; ?>
    <div class = "full-box">
    <div class="information">
       <h2>Plan Your Event</h2>
        <p>
            Our event management platform is designed to simplify every
            step of your event planning journey. From registration
            and ticketing to scheduling,and real-time updates,
            we provide all the tools you need in one place.
            Whether you're attending a wedding, a concert,
            or a public event, our user-friendly interface ensures
            a seamless experience for both organizers and attendees. Let us help
            you turn your vision into a successful and unforgettable event.
        </p>
    </div>
    <div class = "event-container">
        <div class="grid-header">
            <h1>Events</h1>
        </div>
     <div class = "container">
        <div class = event-card-1><a href = "events/night_life.php">Night Life</a></div>
        <div class = event-card-2><a href = "events/nature.php">Nature</a></div>
        <div class = event-card-3><a href = "events/clubbing.php">Clubbing</a></div>
        <div class = event-card-4><a href = "events/sporting.php">Sporting</a></div>
        <div class = event-card-5><a href = "events/camping.php">Camping</a></div>
        <div class = event-card-6><a href = "events/festive.php">Festive</a></div>
        <div class = event-card-7><a href = "events/music_fest.php">Music Festival</a></div>
     </div>
     </div>
    </div>
    </body>
</html>