<template>
  <div class="register">
    <h1>Create Account</h1>
    <p class="start">Enter your registration details</p>
    <form @submit.prevent="register">
      <input type="text" v-model="userName" placeholder="Name" />
      <input type="email" v-model="userEmail" placeholder="Email" />
      <input type="password" v-model="userPass" placeholder="Password" />
      <p class="error">{{ error }}</p>
      <button class="reg_but">Register</button>
    </form>
    <div class="existing_acc">
      <p class="quest">Already have an account?</p>
      <router-link to="/login">Login</router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      userName: '',
      userEmail: '',
      userPass: '',
      error: '',
    };
  },
  methods: {
    register() {
      const userData = {
        name: this.userName,
        email: this.userEmail,
        password: this.userPass,
      };

      const url = 'http://localhost/api/registerUser.php';

      axios
        .post(url, userData, {
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          if (response.data.message === 'User registered successfully') {
            this.$router.push('/login');
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
.register {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
  padding: 20px;
}

.register h1 {
  font-size: 2.5rem;
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

.register p.start {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 20px;
  text-align: center;
}

.register form {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  max-width: 400px;
}

.register input[type="text"],
.register input[type="email"],
.register input[type="password"] {
  width: 100%;
  padding: 15px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

.register input[type="text"]:focus,
.register input[type="email"]:focus,
.register input[type="password"]:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.1);
}

.register .existing_acc {
  margin-top: 20px;
  font-size: 1rem;
  color: #333;
  text-align: center;
}

.register .quest {
  margin: 0;
}

.register .error {
  color: #ff0000;
  margin-top: 10px;
  font-size: 1rem;
  text-align: center;
}

.register button.reg_but {
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

.register button.reg_but:hover {
  background-color: #0056b3;
}

.register button.reg_but:active {
  background-color: #004085;
}

.register button.reg_but:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.5);
}
</style>
