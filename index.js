document.addEventListener("DOMContentLoaded", () => 
    {
  const animatedElements = document.querySelectorAll
  (
    ".highlight, .aim, .events_overview, .card"
  );

  const observerOptions = {
    threshold: 0.2,
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
        observer.unobserve(entry.target); // Optional: animate only once
      }
    });
  }, observerOptions);

  animatedElements.forEach((el) => {
    el.classList.add("pre-animate");
    observer.observe(el);
  });
});

// Card swipe logic

document.addEventListener("DOMContentLoaded", () => 

    // Input events from database

    {
  const events = 
  [
    {
      title: "EcoPulse 2025",
      location: "Panjim, Goa",
      image: "./images/Event1.jpg",
      description: 
      [
        "EcoPulse 2025 is more than just an event—it's a movement. Held at the heart of Panjim, this year’s edition brings together changemakers, innovators, and everyday citizens to explore bold solutions for a sustainable future.",
        "From interactive workshops and green tech showcases to community clean-up drives and climate talks, EcoPulse 2025 is designed to spark awareness and inspire action.",
        "Join us as we pulse with purpose—and turn ideas into impact."
      ]
    },

    {
      title: "TechBloom 2025",
      location: "Bangalore, India",
      image: "./images/Event2.png",
      description: 
      [
        "TechBloom 2025 is India’s premier innovation summit, spotlighting AI, robotics, and sustainable tech.",
        "Expect keynote speeches from global tech leaders, hands-on demos, and startup showcases.",
        "A must-attend for developers, entrepreneurs, and curious minds shaping tomorrow."
      ]
    },

    {
      title: "CultureConnect 2025",
      location: "Stuttgart, Germany",
      image: "./images/Event3.png",
      description: 
      [
        "CultureConnect 2025 celebrates diversity through music, food, fashion, and storytelling.",
        "Experience vibrant performances, global cuisines, and interactive cultural exhibits.",
        "Perfect for families, travelers, and anyone who believes in unity through culture."
      ]
    },

    {
      title: "GreenFuture Expo 2025",
      location: "Nashik, India",
      image: "./images/Event4.png",
      description:
      [
        "GreenFuture Expo 2025 is a showcase of eco-innovation—from solar tech to biodegradable packaging.",
        "Meet industry leaders, attend sustainability workshops, and explore green startups.",
        "Let’s build a cleaner, smarter future together."
      ]
    }
  ];

  const card = document.querySelector(".card");
  const circles = document.querySelectorAll(".circle");

  let currentIndex = 0, interval;

  function updateCard(index) 
  {
//  Current event displayed
  const event = events[index];

  // Animate out
  card.classList.remove("active");
  card.classList.add("slide-out");

  setTimeout(() => 
    {
    card.querySelector("h4").textContent = event.title;
    card.querySelector("h6").textContent = `Location: ${event.location}`;
    card.querySelector("#Event_icon").src = event.image;
    card.querySelectorAll("p")[0].textContent = event.description[0];
    card.querySelectorAll("p")[1].textContent = event.description[1];
    card.querySelectorAll("p")[2].textContent = event.description[2];

    // Animate in
    card.classList.remove("slide-out");
    card.classList.add("slide-in");

    setTimeout(() => 
        {
      card.classList.remove("slide-in");
      card.classList.add("active");
    }, 600);
  }, 500); // Delay for sync. Adjust later on

// Circle fill update
  circles.forEach((c, i) => c.id = i === index ? "filled" : "");
  currentIndex = index;
}

  function autoRotate() 
  {
    interval = setInterval(() => 
    {
      let nextIndex = (currentIndex + 1) % events.length;
      updateCard(nextIndex);
    }, 5000);
  }

  circles.forEach((circle, index) => 
    {
    circle.addEventListener("click", () => 
    {
      clearInterval(interval);
      updateCard(index);
      autoRotate();
    });
  });

  updateCard(0);
  autoRotate();
});