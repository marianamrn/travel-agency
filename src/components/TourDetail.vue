<template>
  <div v-if="tour" class="tour-detail">
    <h1 class="tour-title">{{ tour.name }}</h1>
    <!-- Карусель для зображень -->
    <div v-if="tour.images.length" class="carousel">
      <div v-for="(image, index) in tour.images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
        <img :src="image.img_src" :alt="image.img_alt">
      </div>
      <button @click="prevSlide" class="prev">Prev</button>
      <button @click="nextSlide" class="next">Next</button>
    </div>
    <!-- Інформація про тур -->
    <div class="tour-info">
      <h2>Tour Details</h2>
      <p><strong>Description:</strong> {{ tour.description }}</p>
      <p><strong>Included Services:</strong> {{ tour.included_services }}</p>
      <p><strong>Duration:</strong> {{ tour.duration }} days</p>
      <p><strong>Price:</strong> ${{ tour.price }}</p>
      <p><strong>Start Location:</strong> {{ tour.start_city }}, {{ tour.start_country }}</p>
      <p><strong>End Location:</strong> {{ tour.end_city }}, {{ tour.end_country }}</p>
      <p><strong>Start Date:</strong> {{ tour.start_date }}</p>
      <p><strong>Category:</strong> {{ tour.category }}</p>
      <p><strong>Max Participants:</strong> {{ tour.max_participants }}</p>
      <button class="reserve-button" @click="reserveTour">Reserve</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { isAuthenticated } from '@/auth'; // Імпорт функції isAuthenticated

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
    reserveTour() {
      if (!isAuthenticated()) {
        this.$router.push('/login');
        return;
      }
      this.$router.push(`/reserveTours/${this.$route.params.id}`);
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
  overflow: hidden;
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
  height: 300px;
  margin-bottom: 20px; /* Відступ знизу для каруселі */
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

.tour-info {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

.tour-info h2 {
  margin-bottom: 15px;
  font-size: 1.8rem;
  color: #044c98;
}

.tour-info p {
  margin: 10px 0;
  font-size: 1rem;
  color: #555;
}

.tour-info p strong {
  color: #333;
}

.reserve-button {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
  font-size: 1.2rem;
}

.reserve-button:hover {
  background-color: #218838;
}

.reserve-button:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.5);
}
</style>