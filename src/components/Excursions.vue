<!-- src/components/Excursions.vue -->
<template>
  <div class="excursions">
    <h1 class="page-title">Our Excursions</h1>
    
    <form @submit.prevent="searchExcursions" class="search-form">
      <div class="search-inputs">
        <input type="text" v-model="search.location" placeholder="Location" />
        <input type="date" v-model="search.date" placeholder="Date" />
        <input type="number" v-model="search.duration" placeholder="Duration (hours)" />
        <select v-model="search.category">
          <option value="">Select Category</option>
          <option value="adventure">Adventure</option>
          <option value="cultural">Cultural</option>
          <option value="historical">Historical</option>
          <option value="other">Other</option>
        </select>
        <button type="submit" class="button-search">Search</button>
      </div>
    </form>

    <div v-if="excursions.length" class="excursions-container">
      <div v-for="excursion in excursions" :key="excursion.id" class="excursion-card" @click="goToExcursionDetail(excursion.id)">
        <img :src="excursion.img_src" :alt="excursion.img_alt" class="excursion-cover">
        <div class="excursion-info">
          <h2 class="excursion-name">{{ excursion.name }}</h2>
          <p class="excursion-duration">Duration: {{ excursion.duration }} hours</p>
          <p class="excursion-price">Price: ${{ excursion.price }}</p>
          <p class="excursion-location">Location: {{ excursion.city }}, {{ excursion.country }}</p>
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
      excursions: [],
      search: {
        location: '',
        date: '',
        duration: '',
        category: ''
      }
    };
  },
  mounted() {
    this.fetchExcursions();
  },
  methods: {
    fetchExcursions() {
      axios.get('http://localhost/api/excursions.php')
        .then(response => {
          this.excursions = response.data;
        })
        .catch(error => {
          console.error('Error fetching excursions:', error);
        });
    },
    searchExcursions() {
      axios.post('http://localhost/api/excursions.php', this.search, {
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        this.excursions = response.data;
      })
      .catch(error => {
        console.error('Error searching excursions:', error);
      });
    },
    goToExcursionDetail(excursionId) {
      this.$router.push({ path: `/excursion/${excursionId}` });
    }
  }
};
</script>

<style scoped>
/* Додайте стилі для форми пошуку */
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

.price-range {
  display: flex;
  align-items: center;
  gap: 5px;
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
