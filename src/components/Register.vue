<template>
    <div class="register">
      <h1>Register</h1>
      <p class="start">Enter your registration details</p>
      <input type="text" v-model="userName" placeholder="Username">
      <input type="password" v-model="userPass" placeholder="Password">
      <input type="email" v-model="userEmail" placeholder="Email">
      <div class="existing_acc">
        <p class="quest">Already have an account?</p>
        <router-link to="/login"><button class="login_but">Click here</button></router-link>
      </div>
      <p class="error">{{ error }}</p>
      <button class="reg_but" @click="registerUser">Register</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        userName: '',
        userPass: '',
        userEmail: '',
        error: ''
      };
    },
    methods: {
      registerUser() {
        const userData = {
          name: this.userName,
          password: this.userPass,
          email: this.userEmail
        };
  
        const url = 'http://localhost/api/registerUser.php';
  
        axios.post(url, userData, {
          headers: {
            'Content-Type': 'application/json'
          }
        })
          .then(response => {
            if (response.data.message === "User registered successfully") {
              this.$router.push('/login');
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
  input[type="text"],
  input[type="password"],
  input[type="email"] {
    width: 100%;
    height: 40px;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 22px;
  }
  
  .register {
    width: 800px;
    margin: 0 auto;
  }
  
  .start {
    color: #666;
    font-size: 22px;
  }
  
  .error {
    color: red;
    margin-top: 5px;
    font-size: 22px;
  }
  
  .reg_but {
    padding: 10px 20px;
    background-color: #ec70a8;
    color: #fff;
    border-radius: 5px;
    border-style: none;
    cursor: pointer;
    transition: background-color 0.5s;
    font-size: 22px;
  }
  
  .reg_but:hover {
    background-color: #cb4d86;
  }
  
  .existing_acc {
    display: flex;
    justify-content: space-between;
  }
  
  .quest {
    color: rgb(59, 81, 126);
    font-size: 20px;
  }
  
  .login_but {
    border-style: none;
    background: none;
    color: rgb(59, 81, 126);
    font-size: 20px;
    font-style: italic;
    text-decoration: underline;
    border-radius: 15px;
    transition: background-color 0.5s;
    height: 40px;
    margin-top: 10px;
  }
  
  .login_but:hover {
    color: #fff;
    background: rgb(64, 91, 147);
  }
  </style>
  