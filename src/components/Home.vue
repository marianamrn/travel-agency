<template>
  <div class="home-cover">
    <img class="cover-img" src="@/assets/images/cover.jpg" alt="cover">
    <h1>DISCOVER THIS WORLD<br>WITH YOUR TRAVEL</h1>
    <img class="travel24-img" src="@/assets/images/247.png" alt="247">
  </div>
  <div v-if="images.length" class="carousel">
    <div v-for="(image, index) in images" :key="index" class="carousel-item" :class="{ active: index === activeIndex }">
      <img :src="image.src" :alt="image.alt" class="carousel-img">
    </div>
    <button @click="prevSlide" class="prev">‹</button>
    <button @click="nextSlide" class="next">›</button>
  </div>

  <div class="news-section">
    <button @click="prevNews" class="prev-news">‹ </button>
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
    <button @click="nextNews" class="next-news"> ›</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      images: [],
      activeIndex: 0,
      news: [],
      newsIndex: 0
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
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('en-US', options);
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

html {
  scroll-behavior: smooth;
}

.carousel {
  position: relative;
  width: 100%;
  margin: 0 auto;
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
  color: #333;
}

.news-info p {
  font-size: 1rem;
  margin: 5px 0;
  color: #555;
}

.prev-news, .next-news {
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 1000;
  border-radius: 50%;
}

.prev-news:hover, .next-news:hover {
  background-color: rgba(0, 0, 0, 0.7);
}
</style>
