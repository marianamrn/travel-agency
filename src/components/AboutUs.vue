<template>
  <div class="about-us">
    <h1>About Us</h1>
    <section class="countries">
      <h2>Countries We Collaborate With</h2>
      <!-- Мапа країн, з якими співпрацює компанія -->
      <iframe
        src="https://www.google.com/maps/d/embed?mid=your_map_id"
        width="640"
        height="480"
        frameborder="0"
        style="border:0"
        allowfullscreen
      ></iframe>
    </section>
    <section class="booking-guide">
      <h2>Booking Guide</h2>
      <!-- Гайд по бронюванню -->
      <ol>
        <li>Choose your destination.</li>
        <li>Select your travel dates.</li>
        <li>Provide traveler information.</li>
        <li>Make a payment to confirm your booking.</li>
        <li>Receive your booking confirmation.</li>
      </ol>
    </section>
  </div>
</template>

<script>
export default {
};
</script>

<style scoped>
.about-us {
  font-family: Arial, sans-serif;
  padding: 20px;
}

.about-us h1 {
  font-size: 2em;
  margin-bottom: 20px;
}

.about-us section {
  margin-bottom: 40px;
}

.about-us h2 {
  font-size: 1.5em;
  margin-bottom: 10px;
  color: #333;
}

.about-us iframe {
  width: 100%;
  height: 480px;
  border: none;
  margin-top: 10px;
}

.booking-guide ol {
  padding-left: 20px;
}

.booking-guide li {
  margin-bottom: 10px;
}
</style>
