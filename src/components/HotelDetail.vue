<template>
  <div v-if="hotel" class="hotel-detail">
    <h1 class="hotel-title">{{ hotel.name }}</h1>
    <!-- Карусель для зображень -->
    <div v-if="images.length" class="carousel">
      <div v-for="(image, index) in images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
        <img :src="image.src" :alt="image.alt">
      </div>
      <button @click="prevSlide" class="prev">Prev</button>
      <button @click="nextSlide" class="next">Next</button>
    </div>
    <!-- Інформація про готель -->
    <div class="hotel-info">
      <h2>Hotel Details</h2>
      <p><strong>Description:</strong> {{ hotel.description }}</p>
      <p><strong>Rating:</strong> {{ hotel.rating }}</p>
      <p><strong>City:</strong> {{ hotel.city }}</p>
      <p><strong>Country:</strong> {{ hotel.country }}</p>
      <p><strong>Address:</strong> {{ hotel.address }}</p>
      <p><strong>Phone:</strong> {{ hotel.phone }}</p>
      <p><strong>Email:</strong> {{ hotel.email }}</p>
      <p><strong>Number of Rooms:</strong> {{ hotel.number_of_rooms }}</p>
      <p><strong>Amenities:</strong> {{ hotel.amenities }}</p>
      <p><strong>Standard Price:</strong> ${{ hotel.std_price }}</p>
      <p><strong>Studio Price:</strong> ${{ hotel.studio_price }}</p>
      <p><strong>Suite Price:</strong> ${{ hotel.suite_price }}</p>
      <p><strong>Luxe Price:</strong> ${{ hotel.luxe_price }}</p>
      <p><strong>President Price:</strong> ${{ hotel.president_price }}</p>
      <button class="reserve-button" @click="reserveHotel">Reserve</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { isAuthenticated } from '@/auth';

export default {
  data() {
    return {
      hotel: null,
      images: [],
      activeIndex: 0
    };
  },
  created() {
    this.fetchHotelDetails();
  },
  methods: {
    fetchHotelDetails() {
      const hotelId = this.$route.params.id;
      axios.get(`http://localhost/api/hotel_detail.php?id=${hotelId}`)
        .then(response => {
          this.hotel = response.data.hotel;
          this.images = response.data.images;
        })
        .catch(error => {
          console.error('Error fetching hotel details:', error);
        });
    },
    nextSlide() {
      if (this.images.length > 0) {
        this.activeIndex = (this.activeIndex + 1) % this.images.length;
      }
    },
    prevSlide() {
      if (this.images.length > 0) {
        this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
      }
    },
    reserveHotel() {
  if (!isAuthenticated()) {
    this.$router.push('/login');
    return;
  }
  this.$router.push(`/hotelReservation/${this.$route.params.id}`);
}
  }
};
</script>

<style scoped>
.hotel-detail {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.hotel-title {
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
  margin-bottom: 20px;
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

.hotel-info {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

.hotel-info h2 {
  margin-bottom: 15px;
  font-size: 1.8rem;
  color: #044c98;
}

.hotel-info p {
  margin: 10px 0;
  font-size: 1rem;
  color: #555;
}

.hotel-info p strong {
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
  transition: background-color 0.3s; 
}

.reserve-button:hover {
  background-color: #218838; 
}

.reserve-button:focus {
  outline: none; 
  box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.5); 
}
</style>