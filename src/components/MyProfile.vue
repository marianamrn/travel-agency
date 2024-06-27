<template>
  <div v-if="isAuthenticated">
    <div class="myprofile">
      <h1>Account</h1>
      <p class="start">Welcome to your personal account, {{ user.name }}!</p>
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
  <div v-else class="unauthorized">
    <h1>Account</h1>
    <p class="start">You are not authorized. Please log in to your account.</p>
    <router-link to="/login" class="login-btn">Log in</router-link>
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
      logout(); 
      this.$router.push('/login'); 
    }
  }
};
</script>

<style scoped>
.myprofile,
.unauthorized {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  border-radius: 8px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
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

.unauthorized h1 {
  font-size: 2.5rem;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

.unauthorized .start {
  font-size: 1.2rem;
  color: #666;
  text-align: center;
  margin-bottom: 20px;
}

.unauthorized .login-btn {
  display: block;
  text-align: center;
  width: 120px;
  font-size: 1rem;
  color: #fff;
  background-color: #007bff;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 5px;
  margin: 20px auto 0 auto; /* Center the button horizontally */
  transition: background-color 0.3s;
}

.unauthorized .login-btn:hover {
  background-color: #0056b3;
}

@media (max-width: 600px) {
  .myprofile,
  .unauthorized {
    padding: 10px;
  }
  .start {
    font-size: 1rem;
  }
  .user_info_table th,
  .user_info_table td {
    padding: 8px;
  }
  .unauthorized .start {
    font-size: 1rem;
  }
}
</style>
