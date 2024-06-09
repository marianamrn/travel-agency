<template>
    <nav class="menu">
      <ul>
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/about-us">About Us</router-link></li>
        <li><router-link to="/tours">Tours</router-link></li>
        <li><router-link to="/excursions">Excursions</router-link></li>
        <li><router-link to="/hotels">Hotels</router-link></li>
        <li><router-link to="/news">News</router-link></li>
        <li><router-link to="/contacts">Contacts</router-link></li>
      </ul>
    </nav>
  </template>
  
  <script>
  export default {
  };
  </script>
  
  <style scoped>
  .menu {
    background-color: #333;
    overflow: hidden;
  }
  
  .menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }
  
  .menu li {
    float: left;
  }
  
  .menu li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  
  .menu li a:hover {
    background-color: #111;
  }
  </style>
  