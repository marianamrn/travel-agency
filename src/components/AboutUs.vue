<template>
  <div class="about-us">
    <h1>About Us</h1>
    <section class="countries">
      <h2>Countries We Collaborate With</h2>
      <GoogleMap api-key="AIzaSyBGqlwhKzehBmaxZKsYBMtKkKy998g94nc" :zoom="3" :center="center" style="width: 100%; height: 500px;">
        <Marker v-for="location in locations" :key="location.name" :options="{ position: location.position, title: location.name }" />
      </GoogleMap>
    </section>
    <section class="booking-guide">
      <h2>Booking Guide</h2>
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
import { defineComponent } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";

export default defineComponent({
  components: { GoogleMap, Marker },
  setup() {
    const center = { lat: 20.0, lng: 0.0 };
    const locations = [
      { name: "Paris", position: { lat: 48.8566, lng: 2.3522 } },
      { name: "Madrid", position: { lat: 40.4168, lng: -3.7038 } },
      { name: "Rome", position: { lat: 41.9028, lng: 12.4964 } },
      { name: "Oslo", position: { lat: 59.9139, lng: 10.7522 } },
      { name: "New York", position: { lat: 40.7128, lng: -74.0060 } },
      { name: "Kiev", position: { lat: 50.4501, lng: 30.5234 } },
      { name: "Tokyo", position: { lat: 35.6895, lng: 139.6917 } },
    ];
    return { center, locations };
  }
});
</script>

<style scoped>
.about-us {
  font-family: Arial, sans-serif;
  padding: 20px;
  max-width: 1200px;
  margin: auto;
}

.about-us h1 {
  font-size: 2em;
  margin-bottom: 20px;
  text-align: center;
}

.about-us section {
  margin-bottom: 40px;
}

.about-us h2 {
  font-size: 1.5em;
  margin-bottom: 10px;
  color: #333;
}

.countries {
  text-align: center;
}

.booking-guide ol {
  padding-left: 20px;
}

.booking-guide li {
  margin-bottom: 10px;
}
</style>
