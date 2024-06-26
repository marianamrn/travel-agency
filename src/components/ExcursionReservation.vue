<template>
    <div class="reservation">
      <h1>Excursion Reservation</h1>
      <form @submit.prevent="reserveExcursion">
        <input type="text" v-model="name" placeholder="Name" required />
        <input type="email" v-model="email" placeholder="Email" required />
        <input type="tel" v-model="phone" placeholder="Phone" required />
        <input type="number" v-model="participants" placeholder="Participants" required min="1" />
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
      reserveExcursion() {
        const userId = getUser().id;
        const excursionId = this.$route.params.id;
  
        axios.post('http://localhost/api/excursion_reserve.php', {
          userId,
          excursionId,
          name: this.name,
          email: this.email,
          phone: this.phone,
          participants: this.participants
        })
        .then(response => {
          if (response.data.success) {
            this.success = 'Reservation successful';
            this.error = '';
          } else {
            this.error = response.data.message;
            this.success = '';
          }
        })
        .catch(error => {
          this.error = 'Error connecting to the server.';
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
  .reservation button {
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .reservation button {
    background-color: #4CAF50;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .reservation button:hover {
    background-color: #45a049;
  }
  
  .reservation .error {
    color: #ff0000;
  }
  
  .reservation .success {
    color: #4CAF50;
  }
  </style>
  