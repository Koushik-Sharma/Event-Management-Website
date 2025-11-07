
const events = {
    "Rooftop Party": {
        address:"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3843.637235006917!2d73.75138417517113!3d15.557565985050156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfea1b61600e59%3A0x6b929808fc6a3d63!2sTitos%20Lane%202%2C%20Calangute%2C%20Baga%2C%20Goa%20403516!5e0!3m2!1sen!2sin!4v1759675056231!5m2!1sen!2sin",
        date: "Oct 10, 2025",
        time: "8:00 PM - 11:00 PM",
        venue: "Tito's Lane, Baga",
        description: "Enjoy music and cocktails under the stars."
    },
    "Live Jazz Night": {
        address: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3848.0523242706245!2d73.89883360000002!3d15.31939134761993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfb72368ad2b01%3A0x14c1d4be3eda2839!2sJamming%20Goat!5e0!3m2!1sen!2sin!4v1759672758566!5m2!1sen!2sin",
        date: "Oct 15, 2025",
        time: "9:00 PM - 12:00 AM",
        venue: "Jamming Goat, Uttorda",
        description: "A night of live jazz performances."
    },
    "Dance Marathon": {
        address: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61486.892632927134!2d73.67235305454062!3d15.595346251509667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfe97ed6a83d0f%3A0xd1a1cfca5155695!2sHill%20Top%20Goa!5e0!3m2!1sen!2sin!4v1759672899256!5m2!1sen!2sin",
        date: "Oct 20, 2025",
        time: "10:00 PM - 4:00 AM",
        venue: "Hill Top, Calangute",
        description: "Dance the night away with top DJs."
    },
    "Gourmet Food Truck Festival": {
        address: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61563.81671612563!2d73.82459484863283!3d15.336437499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfb75a2b8cb455%3A0x6bc5208b914e66cb!2sSnack%20O'%20Mania%20Food%20Truck!5e0!3m2!1sen!2sin!4v1759674082027!5m2!1sen!2sin",
        date: "Oct 25, 2025",
        time: "6:00 PM - 11:00 PM",
        venue: "Snack O' Mania Food Truck, Arossim",
        description: "Explore late-night gourmet food options."
    },

    "Midnight Movie Screening": {
        address: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3846.619637317851!2d73.81035717512191!3d15.397072485189232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfc7bc0ccea897%3A0xe99fc990322ef9ae!2s1930%20Vasco!5e0!3m2!1sen!2sin!4v1759674550773!5m2!1sen!2sin",
        date: "Oct 31, 2025",
        time: "12:00 AM onwards",
        venue: "1930 Vasco Mall, Vasco da Gama",
        description: "Midnight screening of classic hits."
    }
};

document.querySelectorAll(".event-list ul li a").forEach(link => {
    link.addEventListener("click", function(e) {
        e.preventDefault();
        const eventName = this.innerText;
        const eventData = events[eventName];

        if (eventData) {
     
            const introText = document.getElementById("intro-text");
            if (introText) introText.style.display = "none";

            const mapBox = document.getElementById("map-box");
            mapBox.style.display = "block";
            const mapImg = document.getElementById("map");
            mapImg.src = eventData.address;
            mapImg.style.display = "block";

            document.getElementById("event-name").innerText = eventName;
            document.getElementById("event-date").innerText = `Date: ${eventData.date}`;
            document.getElementById("event-time").innerText = `Time: ${eventData.time}`;
            document.getElementById("event-venue").innerText = `Venue: ${eventData.venue}`;
            document.getElementById("event-description").innerText = `Description: ${eventData.description}`;
        }
        else{}
    });
});
