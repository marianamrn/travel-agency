<template>
  <div class="tours">
    <h1 class="page-title">Our Tours</h1>
    <div v-if="tours.length" class="tours-container">
      <div v-for="tour in tours" :key="tour.id" class="tour-card">
        <img :src="tour.img_src" :alt="tour.img_alt" class="tour-cover">
        <div class="tour-info">
          <h2 class="tour-name">{{ tour.name }}</h2>
          <p class="tour-duration">Duration: {{ tour.duration }} days</p>
          <p class="tour-price">Price: ${{ tour.price }}</p>
          <p class="tour-locations">From: {{ tour.start_location }} to {{ tour.end_location }}</p>
        </div>
      </div>
    </div>
    <div v-else class="no-tours">
      <p>No tours available.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      tours: []
    };
  },
  mounted() {
    axios.get('http://localhost/api/tours.php')
  .then(response => {
    this.tours = response.data;
  })
  .catch(error => {
    console.error('Error fetching tours:', error);
  });
  }
};
</script>

<style scoped>
.page-title {
  text-align: center;
  margin: 20px 0;
  font-size: 2.5rem;
  color: #333;
}

.tours-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
}

.tour-card {
  width: 300px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s, box-shadow 0.3s;
}

.tour-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.tour-cover {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.tour-info {
  padding: 15px;
}

.tour-name {
  font-size: 1.5rem;
  margin: 0 0 10px;
  color: #044c98;
}

.tour-duration,
.tour-price,
.tour-locations {
  font-size: 1rem;
  margin: 5px 0;
  color: #555;
}

.no-tours {
  text-align: center;
  color: #777;
}
</style>
