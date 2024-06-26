<template>
  <div class="hotels">
    <h1 class="page-title">Our Hotels</h1>
    
    <!-- Search Form -->
    <form @submit.prevent="fetchHotels" class="search-form">
      <div class="search-inputs">
        <input v-model="search.city" type="text" placeholder="City" />
        <div class="rating-filter">
          <label>Rating:</label>
          <span v-for="star in 5" :key="star" 
                :class="{'selected': search.rating >= star}" 
                @click="setRating(star)">
            ★
          </span>
        </div>
        <div class="price-range">
          <label>Min Price: ${{ search.minPrice }}</label>
          <input type="range" v-model="search.minPrice" min="0" max="1000" step="10" />
        </div>
        <div class="price-range">
          <label>Max Price: ${{ search.maxPrice }}</label>
          <input type="range" v-model="search.maxPrice" min="0" max="1000" step="10" />
        </div>
        <button type="submit" class="button-search">Search</button>
      </div>
    </form>
    
    <div v-if="hotels.length" class="hotels-container">
      <div v-for="hotel in hotels" :key="hotel.id" class="hotel-card">
        <img :src="hotel.img_src" :alt="hotel.img_alt" class="hotel-cover">
        <div class="hotel-info">
          <h2 class="hotel-name">{{ hotel.name }}</h2>
          <p class="hotel-rating">Rating: {{ hotel.rating }}</p>
          <p class="hotel-city">City: {{ hotel.city }}</p>
          <p class="hotel-price">Price from: ${{ hotel.std_price }} /night</p>
        </div>
      </div>
    </div>
    <div v-else class="no-hotels">
      <p>No hotels found.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      hotels: [],
      search: {
        city: '',
        rating: 0,
        minPrice: 0,
        maxPrice: 1000
      }
    };
  },
  methods: {
    fetchHotels() {
      axios.get('http://localhost/api/hotels.php', {
        params: this.search
      })
      .then(response => {
        this.hotels = response.data;
      })
      .catch(error => {
        console.error('Error fetching hotels:', error);
      });
    },
    setRating(star) {
      this.search.rating = star;
    }
  },
  mounted() {
    this.fetchHotels();
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

.search-form {
  background-color: #fff;
  border-radius: 15px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  padding: 15px;
  max-width: 1300px;
  margin: 0 auto 20px;
  transition: box-shadow 0.3s;
}

.search-form:hover {
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
}

.search-inputs {
  display: flex;
  gap: 10px;
  align-items: center;
  justify-content: space-between;
}

.search-form input,
.search-form select,
.price-range input {
  padding: 10px;
  font-size: 0.875rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 180px;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: border-color 0.3s, box-shadow 0.3s;
}

.search-form input:focus,
.search-form select:focus,
.price-range input:focus {
  border-color: #007bff;
  box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.15);
  outline: none;
}

.button-search {
  padding: 10px 20px;
  font-size: 0.875rem;
  border: none;
  border-radius: 8px;
  background-color: #007bff;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

.button-search:hover {
  background-color: #0056b3;
  transform: translateY(-2px);
}

.rating-filter {
  display: flex;
  align-items: center;
}

.rating-filter span {
  cursor: pointer;
  font-size: 2rem;
  color: #ddd;
}

.rating-filter span.selected {
  color: gold;
}

.price-range {
  display: flex;
  align-items: center;
  gap: 10px;
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
