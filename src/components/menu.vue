<template>
  <nav class="menu">
    <ul>
      <li><router-link to="/"><img src="\src\assets\images\logo.png" alt="Logo"></router-link></li>
      <li><router-link to="/about-us">About Us</router-link></li>
      <li><router-link to="/tours">Tours</router-link></li>
      <li><router-link to="/excursions">Excursions</router-link></li>
      <li><router-link to="/hotels">Hotels</router-link></li>
      <li><router-link to="/contacts">Contacts</router-link></li>
      <li><router-link to="/myprofile">My Profile</router-link></li>
    </ul>
  </nav>
</template>

<script>
export default {};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}

#app {
  margin: 0;
  padding: 0;
}

.menu {
  background-color: #333;
  overflow: hidden;
  display: flex;
  justify-content: left;
  width: 100%;
}

.menu li:first-child {
  margin-right: auto; 
}

.menu li:first-child img {
  height: 20px; 
  margin: 0px; 
}

.menu ul {
  list-style-type: none;
  display: flex;
  margin: 0; 
  padding: 0; 
}

.menu li {
  display: flex;
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
