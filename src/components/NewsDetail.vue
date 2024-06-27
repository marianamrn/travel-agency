<!-- src/components/NewsDetail.vue -->
<template>
    <div class="news-detail" v-if="newsItem">
      <h1>{{ newsItem.title }}</h1>
      <img :src="newsItem.img_src" :alt="newsItem.img_alt" />
      <p>{{ newsItem.content }}</p>
      <p><strong>Author:</strong> {{ newsItem.author }}</p>
      <p><strong>Published at:</strong> {{ formatDate(newsItem.published_at) }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['id'],
    data() {
      return {
        newsItem: null
      };
    },
    mounted() {
      this.fetchNewsDetail();
    },
    methods: {
      fetchNewsDetail() {
        axios.get(`http://localhost/api/news_detail.php?id=${this.id}`)
          .then(response => {
            this.newsItem = response.data;
          })
          .catch(error => {
            console.error('Error fetching news detail:', error);
          });
      },
      formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options); // Локаль 'en-US' для англійських місяців
      }
    }
  };
  </script>
  
  <style scoped>
  .news-detail {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  
  .news-detail img {
    width: 100%;
    height: auto;
    margin-bottom: 20px;
  }
  
  .news-detail h1 {
    margin: 0 0 20px;
    font-size: 2.5rem;
    color: #333;
  }
  
  .news-detail p {
    margin: 0 0 10px;
    font-size: 1.125rem;
    color: #555;
  }
  </style>
  