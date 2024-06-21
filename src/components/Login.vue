<template>
  <div class="login">
    <h1>Account</h1>
    <p class="start">Enter your login details</p>
    <form @submit.prevent="sendData">
      <input type="email" v-model="userEmail" placeholder="Email" />
      <input type="password" v-model="userPass" placeholder="Password" />
      <p class="error">{{ error }}</p>
      <button class="log_but">Login</button>
    </form>
    <div class="new_acc">
      <p class="quest">Don't have an account yet?</p>
    </div>
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
      error: '',
    };
  },
  methods: {
    sendData() {
      const userData = {
        email: this.userEmail,
        password: this.userPass,
      };

      const url = 'http://localhost/api/checkUser.php';

      axios
        .post(url, userData, {
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          if (response.data.message === 'User found') {
            setToken(response.data.token);
            setUser(response.data.user);
            this.$router.push('/myprofile');
          } else {
            this.error = response.data.message;
          }
        })
        .catch((error) => {
          this.error = 'Error connecting to the server.';
          console.error('Error:', error);
        });
    },
  },
};
</script>

<style scoped>
.login {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
  padding: 20px;
}

.login h1 {
  font-size: 2.5rem;
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

.login p.start {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 20px;
  text-align: center;
}

.login form {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  max-width: 400px;
}

.login input[type="email"],
.login input[type="password"] {
  width: 100%;
  padding: 15px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

.login input[type="email"]:focus,
.login input[type="password"]:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.1);
}

.login .new_acc {
  margin-top: 20px;
  font-size: 1rem;
  color: #333;
  text-align: center;
}

.login .quest {
  margin: 0;
}

.login .error {
  color: #ff0000;
  margin-top: 10px;
  font-size: 1rem;
  text-align: center;
}

.login button.log_but {
  box-align: center;
  width: 100px;
  padding: 15px 30px;
  margin-top: 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.login button.log_but:hover {
  background-color: #0056b3;
}

.login button.log_but:active {
  background-color: #004085;
}

.login button.log_but:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.5);
}
</style>
