<template>
    <div v-if="excursion" class="excursion-detail">
      <h1 class="excursion-title">{{ excursion.name }}</h1>
      <div v-if="excursion.images.length" class="carousel">
        <div v-for="(image, index) in excursion.images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
          <img :src="image.img_src" :alt="image.img_alt">
        </div>
        <button @click="prevSlide" class="prev">Prev</button>
        <button @click="nextSlide" class="next">Next</button>
      </div>
      <div class="excursion-info">
        <h2>Excursion Details</h2>
        <p><strong>Description:</strong> {{ excursion.description }}</p>
        <p><strong>Language:</strong> {{ excursion.language }}</p>
        <p><strong>Duration:</strong> {{ excursion.duration }} hours</p>
        <p><strong>Date:</strong> {{ excursion.date }}</p>
        <p><strong>Time:</strong> {{ excursion.start_time }} - {{ excursion.end_time }}</p>
        <p><strong>Max Participants:</strong> {{ excursion.max_participants }}</p>
        <p><strong>Price:</strong> ${{ excursion.price }}</p>
        <p><strong>Meeting Point:</strong> {{ excursion.meeting_point }}</p>
        <p><strong>Location:</strong> {{ excursion.city }}, {{ excursion.country }}</p>
        <button class="reserve-button" @click="reserveExcursion">Reserve</button>
      </div>
    </div>
    <div v-else class="no-excursion">
      <p>Excursion details not found.</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { isAuthenticated } from '@/auth';
  
  export default {
    data() {
      return {
        excursion: null,
        activeIndex: 0
      };
    },
    created() {
      this.fetchExcursionDetail();
    },
    methods: {
      fetchExcursionDetail() {
        const excursionId = this.$route.params.id;
        axios.get(`http://localhost/api/excursion_detail.php?id=${excursionId}`)
          .then(response => {
            this.excursion = response.data;
          })
          .catch(error => {
            console.error('Error fetching excursion details:', error);
          });
      },
      reserveExcursion() {
        if (!isAuthenticated()) {
          this.$router.push('/login');
          return;
        }
        this.$router.push(`/reserve/${this.$route.params.id}`);
      },
      nextSlide() {
        if (this.excursion.images.length > 0) {
          this.activeIndex = (this.activeIndex + 1) % this.excursion.images.length;
        }
      },
      prevSlide() {
        if (this.excursion.images.length > 0) {
          this.activeIndex = (this.activeIndex - 1 + this.excursion.images.length) % this.excursion.images.length;
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .excursion-detail {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .excursion-title {
    font-size: 24px;
    margin-bottom: 10px;
    color: #044c98;
  }
  
  .carousel {
    position: relative;
    margin-bottom: 20px;
  }
  
  .carousel-item {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
  }
  
  .carousel-item.active {
    display: block;
  }
  
  .prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    padding: 8px 12px;
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    cursor: pointer;
  }
  
  .prev {
    left: 10px;
  }
  
  .next {
    right: 10px;
  }
  
  .excursion-info {
    padding: 10px;
  }
  
  .excursion-info h2 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
  }
  
  .excursion-info p {
    font-size: 16px;
    margin-bottom: 5px;
    color: #555;
  }
  
  .reserve-button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .reserve-button:hover {
    background-color: #0056b3;
  }
  
  .no-excursion {
    text-align: center;
    color: #777;
    margin-top: 20px;
  }
  </style>
  