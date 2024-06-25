<template>
    <div v-if="tour" class="tour-detail">
      <h1 class="tour-title">{{ tour.name }}</h1>
      <img :src="tour.img_src" :alt="tour.img_alt" class="tour-cover">
      <div class="tour-info">
        <p class="tour-duration">Duration: {{ tour.duration }} days</p>
        <p class="tour-price">Price: ${{ tour.price }}</p>
        <p class="tour-locations">From: {{ tour.start_city }}, {{ tour.start_country }} to {{ tour.end_city }}, {{ tour.end_country }}</p>
        <p class="tour-description">{{ tour.description }}</p>
        <p class="tour-included">Included Services: {{ tour.included_services }}</p>
        <p class="tour-participants">Max Participants: {{ tour.max_participants }}</p>
        <p class="tour-category">Category: {{ tour.category }}</p>
        <p class="tour-start-date">Start Date: {{ tour.start_date }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        tour: null,
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
          })
          .catch(error => {
            console.error('Error fetching tour details:', error);
          });
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
  
  .tour-cover {
    width: 100%;
    height: 400px;
    object-fit: cover;
    margin-bottom: 20px;
  }
  
  .tour-info p {
    margin: 10px 0;
    font-size: 1rem;
    color: #555;
  }
  </style>
  