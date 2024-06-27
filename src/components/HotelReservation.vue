<template>
    <div class="reservation">
      <h1>Hotel Reservation</h1>
      <form @submit.prevent="reserveHotel">
        <input type="text" v-model="name" placeholder="Name" required />
        <input type="email" v-model="email" placeholder="Email" required />
        <input type="tel" v-model="phone" placeholder="Phone" required />
        <input type="number" v-model="participants" placeholder="Participants" required min="1" />
        <select v-model="roomType" required>
          <option disabled value="">Select Room Type</option>
          <option v-for="type in roomTypes" :key="type" :value="type">{{ type }}</option>
        </select>
        <button type="submit">Reserve</button>
        <p v-if="error" class="error">{{ error }}</p>
        <p v-if="success" class="success">{{ success }}</p>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { getUser, isAuthenticated } from '@/auth';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        phone: '',
        participants: 1,
        roomType: '',
        roomTypes: ['Standart', 'Studio', 'Suite', 'Luxe', 'President'],
        error: '',
        success: ''
      };
    },
    created() {
      if (!isAuthenticated()) {
        this.$router.push('/login');
      }
    },
    methods: {
      reserveHotel() {
        const userId = getUser().id;
        const hotelId = this.$route.params.id;
  
        axios.post('http://localhost/api/hotel_reserve.php', {
          userId,
          hotelId,
          name: this.name,
          email: this.email,
          phone: this.phone,
          participants: this.participants,
          roomType: this.roomType
        })
        .then(response => {
          if (response.data.success) {
            this.success = 'Reservation successful';
            this.error = '';
          } else {
            this.error = response.data.message || 'Reservation failed';
            this.success = '';
          }
        })
        .catch(error => {
          console.log(error.response.data);
          this.error = error.response.data.error || 'Error connecting to the server.';
          this.success = '';
        });
      }
    }
  };
  </script>
  
  <style scoped>
  .reservation {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  
  .reservation h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
    color: #333;
  }
  
  .reservation form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  .reservation input,
  .reservation select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .reservation button {
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .reservation button:hover {
    background-color: #0056b3;
  }
  
  .error {
    color: #ff0000;
  }
  
  .success {
    color: #00cc00;
  }
  </style>
  