<template>
  <div class="tours">
    <h1 class="page-title">Our Tours</h1>
    
    <form @submit.prevent="searchTours" class="search-form">
      <div class="search-inputs">
        <input type="text" v-model="search.start_city" placeholder="Start City" />
        <input type="text" v-model="search.end_city" placeholder="End City" />
        <input type="date" v-model="search.start_date" placeholder="Start Date" />
        <input type="number" v-model="search.duration" placeholder="Duration (days)" />
        <select v-model="search.category">
          <option value="">Select Category</option>
          <option value="family">Family</option>
          <option value="romantic">Romantic</option>
          <option value="group">Group</option>
          <option value="other">Other</option>
        </select>
        <input type="number" v-model="search.max_participants" placeholder="Number of Participants" />
        <button type="submit" class="button-search">Search</button>
      </div>
    </form>

    <div v-if="tours.length" class="tours-container">
      <div v-for="tour in tours" :key="tour.id" class="tour-card">
        <img :src="tour.img_src" :alt="tour.img_alt" class="tour-cover">
        <div class="tour-info">
          <h2 class="tour-name">{{ tour.name }}</h2>
          <p class="tour-duration">Duration: {{ tour.duration }} days</p>
          <p class="tour-price">Price: ${{ tour.price }}</p>
          <p class="tour-locations">From: {{ tour.start_city }}, {{ tour.start_country }} to {{ tour.end_city }}, {{ tour.end_country }}</p>
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
      tours: [],
      search: {
        start_city: '',
        end_city: '',
        start_date: '',
        duration: '',
        category: '',
        max_participants: ''
      }
    };
  },
  mounted() {
    this.fetchTours();
  },
  methods: {
    fetchTours() {
      axios.get('http://localhost/api/tours.php')
        .then(response => {
          this.tours = response.data;
        })
        .catch(error => {
          console.error('Error fetching tours:', error);
        });
    },
    searchTours() {
      axios.post('http://localhost/api/tours.php', this.search, {
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        this.tours = response.data;
      })
      .catch(error => {
        console.error('Error searching tours:', error);
      });
    }
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
  flex-wrap: wrap;
  justify-content: space-between;
}

.search-form input,
.search-form select {
  padding: 10px;
  font-size: 0.875rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 180px;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: border-color 0.3s, box-shadow 0.3s;
}

.search-form input:focus,
.search-form select:focus {
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
