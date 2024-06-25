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
      <button class="logout-btn" @click="logout">Log Out</button>
    </div>
  </div>
  <div v-else>
    <h1>Account</h1>
    <p class="start">You are not authorized. Please log in to your account.</p>
    <router-link to="/login" class="login">Login</router-link>
  </div>
</template>

<script>
import { isAuthenticated, getUser, logout } from '@/auth';

export default {
  computed: {
    isAuthenticated() {
      return isAuthenticated();
    },
    user() {
      return getUser();
    }
  },
  methods: {
    logout() {
      logout(); // Видаляємо дані з localStorage
      this.$router.push('/login'); // Перенаправляємо на сторінку логіну після виходу
    }
  }
};
</script>

<style scoped>
/* Global styles */
.myprofile {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  border-radius: 8px;
}

h1 {
  font-size: 2.5rem;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

.start {
  font-size: 1.2rem;
  color: #666;
  text-align: center;
  margin-bottom: 20px;
}

.user_info {
  margin-top: 20px;
}

.name_table {
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 10px;
}

.user_info_table {
  width: 100%;
  border-collapse: collapse;
}

.user_info_table th,
.user_info_table td {
  border: 1px solid #ccc;
  padding: 10px;
}

.user_info_table th {
  background-color: #f2f2f2;
  text-align: left;
}

.user_info_table td {
  text-align: left;
}

.logout-btn {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
  transition: background-color 0.3s;
}

.logout-btn:hover {
  background-color: #c82333;
}

@media (max-width: 600px) {
  .myprofile {
    padding: 10px;
  }
  .start {
    font-size: 1rem;
  }
  .user_info_table th,
  .user_info_table td {
    padding: 8px;
  }
}
</style>
