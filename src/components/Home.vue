<template>
  <div class="home-cover">
    <img class="cover-img" src="@/assets/images/cover.jpg" alt="cover">
    <h1>DISCOVER THIS WORLD<br>WITH YOUR TRAVEL</h1>
    <img class="travel24-img" src="@/assets/images/247.png" alt="247">
  </div>
  <section class="tours">
    <img class="our-tours-photo" src="@/assets/images/page-covers/tours.png" alt="our-tours" @click="goToTours">
    <div v-if="images.length" class="carousel">
      <div v-for="(image, index) in images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
        <img :src="image.src" :alt="image.alt" class="carousel-img">
      </div>
      <button @click="prevSlide" class="prev">‹</button>
      <button @click="nextSlide" class="next">›</button>
    </div>
  </section>
  <section class="news">
    <img class="news-cover" src="@/assets/images/page-covers/news.png" alt="news-cover">
    <div class="news-section">
      <button @click="prevNews" class="prev-news">‹</button>
      <div class="news-carousel">
        <div v-for="newsItem in displayedNews" :key="newsItem.id" class="news-item" @click="goToNewsDetail(newsItem.id)">
          <img :src="newsItem.img_src" :alt="newsItem.img_alt" class="news-img">
          <div class="news-info">
            <h2>{{ newsItem.title }}</h2>
            <p>{{ formatDate(newsItem.published_at) }}</p>
            <p>{{ newsItem.content.substring(0, 100) }}...</p>
          </div>
        </div>
      </div>
      <button @click="nextNews" class="next-news">›</button>
    </div>
  </section>

  <section class="consultation">
    <h2>Consultation</h2>
    <button @click="showForm = !showForm">Ask a question</button>
    <div v-if="showForm" class="form-container">
      <form @submit.prevent="submitForm">
        <div>
          <label for="name">Name:</label>
          <input type="text" v-model="form.name" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="form.email" required>
        </div>
        <div>
          <label for="phone">Phone:</label>
          <input type="text" v-model="form.phone" required>
        </div>
        <div>
          <label for="message">Message:</label>
          <textarea v-model="form.message" required></textarea>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      images: [],
      activeIndex: 0,
      news: [],
      newsIndex: 0,
      showForm: false,
      form: {
        name: '',
        email: '',
        phone: '',
        message: ''
      }
    };
  },
  computed: {
    displayedNews() {
      return this.news.slice(this.newsIndex, this.newsIndex + 4);
    }
  },
  mounted() {
    axios.get('http://localhost/api/get_tours.php')
      .then(response => {
        this.images = response.data;
        this.startCarousel();
      })
      .catch(error => {
        console.error('Error fetching images:', error);
      });

    this.fetchNews();
  },
  methods: {
    startCarousel() {
      setInterval(() => {
        this.nextSlide();
      }, 3000);
    },
    nextSlide() {
      this.activeIndex = (this.activeIndex + 1) % this.images.length;
    },
    prevSlide() {
      this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
    },
    fetchNews() {
      axios.get('http://localhost/api/news.php')
        .then(response => {
          this.news = response.data;
        })
        .catch(error => {
          console.error('Error fetching news:', error);
        });
    },
    nextNews() {
      if (this.newsIndex + 4 < this.news.length) {
        this.newsIndex += 4;
      }
    },
    prevNews() {
      if (this.newsIndex - 4 >= 0) {
        this.newsIndex -= 4;
      }
    },
    goToNewsDetail(id) {
      this.$router.push(`/news/${id}`);
    },
    goToTours() {
      this.$router.push('/tours');
    },
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('en-US', options);
    },
    submitForm() {
      axios.post('http://localhost/api/save_message.php', this.form)
        .then(response => {
          alert('Your message has been sent!');
          this.showForm = false;
          this.form = {
            name: '',
            email: '',
            phone: '',
            message: ''
          };
        })
        .catch(error => {
          console.error('Error submitting form:', error);
        });
    }
  }
};
</script>

<style>
body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  background-color: hsl(220, 15%, 15%);
  overflow-x: hidden;
}

.home-cover {
  position: relative;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.cover-img {
  position: absolute;
  top: 0;
  left: 50%;
  width: 100%;
  height: 250px; 
  transform: translateX(-50%) scale(1.1); 
  object-fit: cover;
  filter: blur(10px);
}

.home-cover h1 {
  position: absolute;
  top: 210px; 
  left: 15%; 
  color: rgb(255, 255, 255);
  font-size: 3rem;
  text-align: center; 
  z-index: 1;
  margin: 0; 
  padding: 0;
}

.travel24-img {
  position: absolute;
  top: 90px; 
  left: 60%; 
  height: 50%;
  width: 25%;
  z-index: 1;
}

.our-tours-photo {
  width: 100%;
  height: 100px;
  object-fit: cover;
  opacity: 0.9;
  margin-top: -500px;
}

.carousel {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.carousel-item {
  display: none;
  transition: opacity 1s ease-in-out;
}

.carousel-item.active {
  display: block;
  opacity: 1;
}

.carousel-img {
  width: 100%;
  height: 100vh; 
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
  z-index: 1000;
}

.prev {
  left: 10px;
}

.next {
  right: 10px;
}

.prev:hover, .next:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

.news-section {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  gap: 20px;
}

.news-cover {
  width: 100%;
  height: 100px;
  object-fit: cover;
  opacity: 0.9;
  margin-top: 50px;
}

.news-carousel {
  display: flex;
  gap: 20px;
  overflow: hidden;
  max-width: calc(400px * 4 + 20px * 3); 
}

.news-item {
  min-width: 300px;
  flex: 1 0 300px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: pointer;
  background-color: white;
}

.news-item:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.news-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.news-info {
  padding: 15px;
}

.news-info h2 {
  font-size: 1.5rem;
  margin: 0 0 10px;
  color: hsl(220, 15%, 15%);
}

.news-info p {
  margin: 0;
  color: hsl(220, 10%, 40%);
}

.prev-news, .next-news {
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 1000;
}

.prev-news:hover, .next-news:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

.consultation {
  padding: 40px 20px;
  background-image: url('@/assets/images/consultation-background.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-color: #f1f1f1;
  margin: 40px 0;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.consultation h2 {
  font-size: 2rem;
  color: hsl(220, 15%, 15%);
  margin-bottom: 20px;
}

.consultation button {
  padding: 10px 20px;
  background-color: #007BFF;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 1rem;
  transition: background-color 0.3s;
}

.consultation button:hover {
  background-color: #0056b3;
}

.form-container {
  margin-top: 20px;
  display: flex;
  justify-content: center;
}

form {
  width: 100%;
  max-width: 600px;
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form div {
  margin-bottom: 15px;
  text-align: left;
}

form label {
  display: block;
  margin-bottom: 5px;
  font-size: 1rem;
  color: hsl(220, 15%, 15%);
}

form input, form textarea {
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 1rem;
}

form input:focus, form textarea:focus {
  border-color: #007BFF;
  outline: none;
}

form button {
  padding: 10px 20px;
  background-color: #007BFF;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 1rem;
  transition: background-color 0.3s;
}

form button:hover {
  background-color: #0056b3;
}
</style>
