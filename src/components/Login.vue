<template>
    <div class="login">
      <h1>Account</h1>
      <p class="start">Enter your login details</p>
      <input type="email" v-model="userEmail" placeholder="Email">
      <input type="password" v-model="userPass" placeholder="Password">
      <div class="new_acc">
        <p class="quest">Don't have an account yet?</p>
        <router-link to="/register"><button class="reg_but">Click here</button></router-link>
      </div>
      <p class="error">{{ error }}</p>
      <button class="log_but" @click="sendData">Login</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { setToken, setUser } from '@/auth';
  
  export default {
    data() {
      return {
        userEmail: '',
        userPass: '',
        error: ''
      };
    },
    methods: {
      sendData() {
        const userData = {
          email: this.userEmail,
          password: this.userPass
        };
  
        const url = 'http://localhost/api/checkUser.php';
  
        axios.post(url, userData, {
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          if (response.data.message === "User found") {
            setToken(response.data.token);
            setUser(response.data.user);
            this.$router.push('/myprofile');
          } else {
            this.error = response.data.message;
          }
        })
        .catch(error => {
          this.error = 'Error connecting to the server.';
          console.error('Error:', error);
        });
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  