<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Night Life Page</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@400..700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="night_life_style.css?v=<?php echo time(); ?>">
</head>

<body>
  <?php include '../navbar.php'; ?>

  <div class="main-box">
    <div class="information">
      <h1>Night Life Events</h1>

      <p id="intro-text">
        Experience the vibrant pulse of the city after dark with our curated night life events.
        From trendy rooftop bars and exclusive nightclubs to live music venues and late-night dining experiences,
        we offer a variety of options to suit every taste. Whether you're looking to dance the night away,
        enjoy a cocktail with friends, or explore the city's hidden gems, our night life events promise unforgettable memories.
        Join us for an evening of excitement, entertainment, and endless possibilities under the city lights.
      </p>

      <div class="map-box" id="map-box" style="display:none;">
        <iframe id="map" width="100%" height="400" style="border:0;" allowfullscreen></iframe>

        <div id="event-info" class="event-info">
          <h2 id="event-name"></h2>
          <p id="event-date"></p>
          <p id="event-time"></p>
          <p id="event-venue"></p>
          <p id="event-description"></p>
        </div>

        <button id="book-btn" class="book-btn" style="display:none;">Book Now</button>
      </div>
    </div>

    <div class="event-list">
      <h2>Upcoming Night Life Events</h2>
      <ul>
      </ul>
    </div>
  </div>

  <script src="/webtech_project/events/night_life.js?v=<?php echo time(); ?>"></script>
</body>
</html>
