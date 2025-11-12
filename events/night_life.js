document.addEventListener("DOMContentLoaded", () => {
  let events = {};

  fetch("../get_events.php")
    .then(response => response.json())
    .then(data => {
      events = data;
      console.log("✅ Events loaded from database:", events);

      const eventList = document.querySelector(".event-list ul");
      if (eventList) {
        eventList.innerHTML = "";

        Object.keys(events).forEach(eventName => {
          const li = document.createElement("li");
          const a = document.createElement("a");
          a.href = "#";
          a.textContent = eventName;
          li.appendChild(a);
          eventList.appendChild(li);
        });
      }

      document.querySelectorAll(".event-list ul li a").forEach(link => {
        link.addEventListener("click", function (e) {
          e.preventDefault();

          const eventName = this.textContent;
          const eventData = events[eventName];

          console.log("🎯 Selected event:", eventName, eventData);

          if (!eventData) return;

          const introText = document.getElementById("intro-text");
          if (introText) introText.style.display = "none";

          const mapBox = document.getElementById("map-box");
          if (mapBox) mapBox.style.display = "block";

          const mapFrame = document.getElementById("map");
          if (mapFrame) {
            mapFrame.src = eventData.address;
            mapFrame.style.display = "block";
          }

          document.getElementById("event-name").textContent = eventName;
          document.getElementById("event-date").textContent = `Date: ${eventData.date}`;
          document.getElementById("event-time").textContent = `Time: ${eventData.time}`;
          document.getElementById("event-venue").textContent = `Venue: ${eventData.venue}`;
          document.getElementById("event-description").textContent = `Description: ${eventData.description}`;

          const bookBtn = document.getElementById("book-btn");
          if (bookBtn) {
            bookBtn.style.display = "inline-block";
            bookBtn.onclick = () => {
              window.location.href = "../booking.php?event=" + encodeURIComponent(eventName);
            };
          }
        });
      });
    })
    .catch(error => {
      console.error("Error fetching events:", error);
      alert("Failed to load events from the server. Please try again later.");
    });
});
