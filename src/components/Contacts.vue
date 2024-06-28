<template>
  <div class="contacts-container">
    <h1>Contact Us</h1>
    <div class="contact-info">
      <div class="info-section">
        <h2>Address</h2>
        <p>34 Sichovuh Strilthiv, Kolomyia, Ukraine</p>
      </div>
      <div class="info-section">
        <h2>Phone</h2>
        <p>+38 (050) 111 5555</p>
      </div>
      <div class="info-section">
        <h2>Email</h2>
        <p>your.travel@travelagency.com</p>
      </div>
      <div class="info-section">
        <h2>Working Hours</h2>
        <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
        <p>Saturday: 10:00 AM - 4:00 PM</p>
        <p>Sunday: Closed</p>
      </div>
    </div>
    <section class="map">
      <h2 class="how-to-find-us">How to find us?</h2>
      <GoogleMap api-key="AIzaSyBGqlwhKzehBmaxZKsYBMtKkKy998g94nc" :zoom="5" :center="center" style="width: 100%; height: 500px;">
        <Marker v-for="location in locations" :key="location.name" :options="{ position: location.position, title: location.name }" />
      </GoogleMap>
    </section>
    <div class="contact-form">
      <h2>Send Us a Message</h2>
      <form @submit.prevent="submitForm">
        <div>
          <label for="name">Name:</label>
          <input type="text" v-model="form.name" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="form.email" required>
        </div>
        <div>
          <label for="phone">Phone:</label>
          <input type="text" v-model="form.phone" required>
        </div>
        <div>
          <label for="message">Message:</label>
          <textarea v-model="form.message" required></textarea>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { GoogleMap, Marker } from "vue3-google-map";

export default {
  components: { GoogleMap, Marker },
  setup() {
    const center = { lat: 20.0, lng: 0.0 };
    const locations = [
      { name: "Kolomyia", position: { lat: 48.5315565, lng: 25.0358233 } },
    ];
    return { center, locations };
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        message: ''
      }
    };
  },
  methods: {
    submitForm() {
      axios.post('http://localhost/api/save_message.php', this.form)
        .then(response => {
          alert('Your message has been sent!');
          this.showForm = false;
          this.form = {
            name: '',
            email: '',
            phone: '',
            message: ''
          };
        })
        .catch(error => {
          console.error('Error submitting form:', error);
        });
    }
  }
};
</script>

<style>
.contacts-container {
  padding: 40px 20px;
  max-width: 800px;
  margin: 0 auto;
  background-color: #f1f1f1;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 2.5rem;
  color: hsl(220, 15%, 15%);
  text-align: center;
  margin-bottom: 20px;
}

.contact-info {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 40px;
}

.info-section {
  flex: 1 1 45%;
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.info-section h2 {
  font-size: 1.5rem;
  color: hsl(220, 15%, 15%);
  margin-bottom: 10px;
}

.info-section p {
  margin: 0;
  color: hsl(220, 10%, 40%);
}

.contact-form {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.contact-form h2 {
  font-size: 2rem;
  color: hsl(220, 15%, 15%);
  margin-bottom: 20px;
}

form div {
  margin-bottom: 15px;
  text-align: left;
}

form label {
  display: block;
  margin-bottom: 5px;
  font-size: 1rem;
  color: hsl(220, 15%, 15%);
}

form input, form textarea {
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 1rem;
}

form input:focus, form textarea:focus {
  border-color: #007BFF;
  outline: none;
}

form button {
  padding: 10px 20px;
  background-color: #007BFF;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 1rem;
  transition: background-color 0.3s;
}

form button:hover {
  background-color: #0056b3;
}

.how-to-find-us {
  font-size: 2rem;
  color: hsl(220, 15%, 15%);
  margin-bottom: 20px;
}
</style>
