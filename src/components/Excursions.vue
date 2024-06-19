<template>
  <div class="excursions">
    <h1 class="page-title">Our Excursions</h1>
    <div v-if="excursions.length" class="excursions-container">
      <div v-for="excursion in excursions" :key="excursion.id" class="excursion-card">
        <img :src="excursion.img_src" :alt="excursion.img_alt" class="excursion-cover">
        <div class="excursion-info">
          <h2 class="excursion-name">{{ excursion.name }}</h2>
          <p class="excursion-duration">Duration: {{ excursion.duration }} hours</p>
          <p class="excursion-price">Price: ${{ excursion.price }}</p>
          <p class="excursion-location">Location: {{ excursion.location }}</p>
        </div>
      </div>
    </div>
    <div v-else class="no-excursions">
      <p>No excursions available.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      excursions: []
    };
  },
  mounted() {
    axios.get('http://localhost/api/excursions.php')
      .then(response => {
        this.excursions = response.data;
      })
      .catch(error => {
        console.error('Error fetching excursions:', error);
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

.excursions-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
}

.excursion-card {
  width: 300px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s, box-shadow 0.3s;
}

.excursion-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.excursion-cover {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.excursion-info {
  padding: 15px;
}

.excursion-name {
  font-size: 1.5rem;
  margin: 0 0 10px;
  color: #044c98;
}

.excursion-duration,
.excursion-price,
.excursion-location {
  font-size: 1rem;
  margin: 5px 0;
  color: #555;
}

.no-excursions {
  text-align: center;
  color: #777;
}
</style>
