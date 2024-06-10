import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Імпортування маршрутизатора
import './styles/reset.css'; // Ваш файл зі стилями

createApp(App)
  .use(router)
  .mount('#app');
