<template>
  <div>
    <h1>Tours</h1>
    <div v-for="tour in tours" :key="tour.id">
      <h2>{{ tour.name }}</h2>
      <img :src="tour.image_path" :alt="tour.name" />
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
  created() {
    this.fetchTours();
  },
  methods: {
    async fetchTours() {
      try {
        const response = await axios.get('http://localhost/api/tours.php');
        this.tours = response.data;
      } catch (error) {
        console.error('Error fetching tours:', error);
      }
    }
  }
};
</script>
