<template>
  <div class="home-cover">
    <img class="cover-img" src="@/assets/images/cover.jpg" alt="cover">
    <h1>DISCOVER THIS WORLD<br>WITH YOUR TRAVEL</h1>
    <img class="travel24-img" src="@/assets/images/247.png" alt="247">
  </div>
</template>

<script>
export default {};
</script>

<style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: hsl(220, 15%, 15%);
    overflow-x: hidden;
  }

  .home-cover {
    position: relative;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
  }

  .cover-img {
    position: absolute;
    top: 0;
    left: 50%;
    width: 100%;
    height: 250px; 
    transform: translateX(-50%) scale(1.1); 
    object-fit: cover;
    filter: blur(10px);
  }

  .home-cover h1 {
    position: absolute;
    top: 210px; /* Позиціонуємо текст на перетині */
    left: 15%; /* Розміщуємо текст зліва */
    color: rgb(255, 255, 255);
    font-size: 3rem;
    text-align: center; /* Вирівнюємо текст по центру всередині блоку */
    z-index: 1;
    margin: 0; 
    padding: 0;
  }

  .travel24-img {
    position: absolute;
    top: 90px; /* Вирівнюємо з h1 */
    left: 60%; /* Розміщуємо зображення біля тексту */
    height: 50%;
    width: 25%;
    z-index: 1;
  }

  html {
    scroll-behavior: smooth;
  }
</style>
