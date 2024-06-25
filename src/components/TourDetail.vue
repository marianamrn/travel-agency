<template>
  <div v-if="tour" class="tour-detail">
      <h1 class="tour-title">{{ tour.name }}</h1>
      <!-- Інша HTML розмітка туру -->

      <!-- Карусель для зображень -->
      <div v-if="tour.images.length" class="carousel">
        <div v-for="(image, index) in tour.images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
          <img :src="image.img_src" :alt="image.img_alt">
        </div>
        <button @click="prevSlide" class="prev">Prev</button>
        <button @click="nextSlide" class="next">Next</button>
      </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      tour: null,
      activeIndex: 0
    };
  },
  created() {
    this.fetchTourDetail();
  },
  methods: {
    fetchTourDetail() {
      const tourId = this.$route.params.id;
      axios.get(`http://localhost/api/tour_detail.php?id=${tourId}`)
        .then(response => {
          this.tour = response.data;
          console.log(this.tour); // Вивід для відлагодження
        })
        .catch(error => {
          console.error('Error fetching tour details:', error);
        });
    },
    nextSlide() {
      if (this.tour.images.length > 0) {
        this.activeIndex = (this.activeIndex + 1) % this.tour.images.length;
      }
    },
    prevSlide() {
      if (this.tour.images.length > 0) {
        this.activeIndex = (this.activeIndex - 1 + this.tour.images.length) % this.tour.images.length;
      }
    }
  }
};
</script>

<style scoped>
.tour-detail {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.tour-title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 2.5rem;
  color: #333;
}

.carousel {
  position: relative;
  display: flex;
  overflow: hidden;
  width: 100%;
  height: 300px; /* Задайте потрібну висоту */
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

.carousel img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.prev, .next {
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

.prev:hover, .next:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

.prev:focus, .next:focus {
  outline: none;
}

.prev {
  left: 10px;
}

.next {
  right: 10px;
}
</style>
