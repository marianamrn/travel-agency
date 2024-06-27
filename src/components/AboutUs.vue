<template>
  <div class="about-us">
    <img class="page-cover" src="@/assets/images/page-covers/about-us.png" alt="cover">
    <section class="who-we-are">
      <img class="who-we-are-photo" src="@/assets/images/Travel Logo.png" alt="Travel Logo">
      <div class="who-we-are-text">
        <h2>Who We Are</h2>
        <p>
          YOUR TRAVEL is more than just a travel agency. We are a passionate team of travel enthusiasts dedicated to making your 
          travel dreams a reality. Established in 2017, we have built a reputation for delivering personalized travel 
          services with an unwavering commitment to quality and satisfaction. Our extensive industry experience and global partnerships 
          enable us to offer unique travel packages and exclusive deals tailored to your needs.
        </p>
      </div>
    </section>
    <section class="our-mission">
      <p>
        At YOUR TRAVEL, our mission is to inspire and facilitate travel by offering exceptional services that exceed our clients' expectations. 
        We strive to create meaningful and enriching travel experiences, fostering a deeper connection between people and the world around them.
      </p>
      <img class="our-mission-photo" src="@/assets/images/our-mission-photo.jpg" alt="Our Mission">
    </section>
    <section class="our-values">
      <h1>Our Values</h1>
      <ul>
        <li>
          <h3>Integrity</h3>
          <p>We build trust through honesty and transparency in all our dealings.</p>
        </li>
        <li>
          <h3>Excellence</h3>
          <p>We pursue the highest standards in everything we do.</p>
        </li>
        <li>
          <h3>Innovation</h3>
          <p>We embrace new ideas and technologies to enhance your travel experience.</p>
        </li>
        <li>
          <h3>Customer Focus</h3>
          <p>Your satisfaction is our top priority.</p>
        </li>
      </ul>
    </section>
    <section class="countries">
      <h2>Countries We Collaborate With</h2>
      <GoogleMap api-key="AIzaSyBGqlwhKzehBmaxZKsYBMtKkKy998g94nc" :zoom="3" :center="center" style="width: 100%; height: 500px;">
        <Marker v-for="location in locations" :key="location.name" :options="{ position: location.position, title: location.name }" />
      </GoogleMap>
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
  color: #fff; /* Updated to white for better visibility on a dark background */
  max-width: 100%;
  margin: auto;
}

.page-cover {
  width: 100%;
  height: 200px;
  object-fit: cover;
  opacity: 0.6;
}

h1 {
  text-align: center;
  margin-bottom: 40px;
  color: #1e90ff;
}

section {
  margin-bottom: 40px;
}

.who-we-are {
  display: flex;
  align-items: center;
}

.who-we-are p {
  margin-top: 20px;
  text-align: justify;
}

.who-we-are-photo {
  width: 230px;
  height: 300px; 
  margin-right: 30px;
  margin-left: 18%;
  margin-top: 50px;
}

.who-we-are-text {
  max-width: 700px;
}

.our-mission {
  position: relative;
  text-align: center;
  color: white;
}

.our-mission-photo {
  width: 100%;
  height: 400px;
  object-fit: cover;
  opacity: 0.6;
  margin-top: 50px;
}

.our-mission p {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 20px;
  border-radius: 10px;
}

.our-values {
  text-align: center;
}

.our-values h1 {
  position: relative;
  text-align: center;
  color: white;
  margin-top: 50px;
}

.our-values ul {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
  gap: 40px;
}

.our-values li {
  background-color: #34495e;
  padding: 20px;
  border-radius: 10px;
  width: 250px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.our-values h3 {
  font-size: 1.5em;
  color: #009cfc;
  margin-bottom: 10px;
}

.our-values p {
  font-size: 1em;
  color: #ecf0f1;
}

.countries {
  text-align: center;
}

.countries h2 {
  margin-bottom: 20px;
  margin-top: 50px;
}
</style>
