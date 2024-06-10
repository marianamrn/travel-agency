import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './styles/reset.css';  // Імпорт файлу скидання стилів

createApp(App)
  .use(router)
  .mount('#app');
