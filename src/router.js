import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import AboutUs from './components/AboutUs.vue';
import Tours from './components/Tours.vue';
import Excursions from './components/Excursions.vue';
import Hotels from './components/Hotels.vue';
import News from './components/News.vue';
import Contacts from './components/Contacts.vue';
import Login from './components/Login.vue';
import MyProfile from './components/MyProfile.vue';
import Register from './components/Register.vue'; 
import TourDetail from './components/TourDetail.vue'; // Імпорт нового компонента

const routes = [
  { path: '/', component: Home },
  { path: '/about-us', component: AboutUs },
  { path: '/tours', component: Tours },
  { path: '/excursions', component: Excursions },
  { path: '/hotels', component: Hotels },
  { path: '/news', component: News },
  { path: '/contacts', component: Contacts },
  { path: '/login', component: Login },
  { path: '/myprofile', component: MyProfile },
  { path: '/register', component: Register },
  { path: '/tour/:id', component: TourDetail, props: true } // Додаємо маршрут для деталей туру
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
