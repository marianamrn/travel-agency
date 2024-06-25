<template>
  <div class="home-cover">
    <img class="cover-img" src="@/assets/images/cover.jpg" alt="cover">
    <h1>DISCOVER THIS WORLD<br>WITH YOUR TRAVEL</h1>
    <img class="travel24-img" src="@/assets/images/247.png" alt="247">
  </div>
  <div v-if="images.length" class="carousel">
    <div v-for="(image, index) in images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
      <img :src="image.src" :alt="image.alt" class="carousel-img">
    </div>
  </div>
  <button @click="prevSlide" class="prev">Prev</button>
  <button @click="nextSlide" class="next">Next</button>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      images: [],
      activeIndex: 0
    };
  },
  mounted() {
    axios.get('http://localhost/api/get_tours.php')
      .then(response => {
        this.images = response.data;
        this.startCarousel();
      })
      .catch(error => {
        console.error('Error fetching images:', error);
      });
  },
  methods: {
    startCarousel() {
      setInterval(() => {
        this.nextSlide();
      }, 3000); // Змінюйте слайд кожні 3 секунди
    },
    nextSlide() {
      this.activeIndex = (this.activeIndex + 1) % this.images.length;
    },
    prevSlide() {
      this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
    }
  }
};
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

/* Стилі для каруселі */
.carousel {
  display: flex;
  overflow: hidden;
  width: 100%;
  height: 50vh; /* Задайте потрібну висоту */
  position: relative;
}

.carousel-item {
  flex: 0 0 100%;
  transition: transform 0.5s ease-in-out, opacity 1s ease-in-out;
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
}

.carousel-item.active {
  opacity: 1;
}

.carousel-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.prev, 
.next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 1;
}

button:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

button:focus {
  outline: none;
}

.prev:first-of-type {
  left: 10px;
}

.next:last-of-type {
  right: 10px;
}
</style>
