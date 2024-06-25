<template>
    <div v-if="isAuthenticated">
      <div class="myprofile">
        <h1>Account</h1>
        <p class="start">Welcome, {{ user.name }}! Welcome to your personal account!</p>
        <div class="user_info">
          <p class="name_table">Basic Information</p>
          <table class="user_info_table">
            <tr>
              <th>Field</th>
              <th>Value</th>
            </tr>
            <tr>
              <td>Username</td>
              <td>{{ user.name }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{ user.email }}</td>
            </tr>
            <tr>
              <td>Join Date</td>
              <td>{{ user.created_at }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div v-else>
      <h1>Account</h1>
      <p class="start">You are not authorized. Please log in to your account.</p>
      <router-link to="/login" class="login">Login</router-link>
    </div>
  </template>
  
  <script>
  import { isAuthenticated, getUser } from '@/auth';
  
  export default {
    computed: {
      isAuthenticated() {
        return isAuthenticated();
      },
      user() {
        return getUser();
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  