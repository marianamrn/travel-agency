<template>
  <div class="hotels">
    <h1 class="page-title">Our Hotels</h1>
    <div v-if="hotels.length" class="hotels-container">
      <div v-for="hotel in hotels" :key="hotel.id" class="hotel-card">
        <img :src="hotel.img_src" :alt="hotel.img_alt" class="hotel-cover">
        <div class="hotel-info">
          <h2 class="hotel-name">{{ hotel.name }}</h2>
          <p class="hotel-rating">Rating: {{ hotel.rating }}</p>
          <p class="hotel-city">City: {{ hotel.city }}</p>
          <p class="hotel-price">Start Price: ${{ hotel.std_price }}/night</p>
        </div>
      </div>
    </div>
    <div v-else class="no-hotels">
      <p>No hotels available.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      hotels: []
    };
  },
  mounted() {
    axios.get('http://localhost/api/hotels.php')
      .then(response => {
        this.hotels = response.data;
      })
      .catch(error => {
        console.error('Error fetching hotels:', error);
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

.hotels-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
}

.hotel-card {
  width: 300px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s, box-shadow 0.3s;
}

.hotel-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.hotel-cover {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.hotel-info {
  padding: 15px;
}

.hotel-name {
  font-size: 1.5rem;
  margin: 0 0 10px;
  color: #044c98;
}

.hotel-rating,
.hotel-city,
.hotel-price {
  font-size: 1rem;
  margin: 5px 0;
  color: #555;
}

.no-hotels {
  text-align: center;
  color: #777;
}
</style>
