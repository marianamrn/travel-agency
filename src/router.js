import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import AboutUs from './components/AboutUs.vue';
import Tours from './components/Tours.vue';
import Excursions from './components/Excursions.vue';
import Hotels from './components/Hotels.vue';
import News from './components/News.vue';
import Contacts from './components/Contacts.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/about-us', component: AboutUs },
  { path: '/tours', component: Tours },
  { path: '/excursions', component: Excursions },
  { path: '/hotels', component: Hotels },
  { path: '/news', component: News },
  { path: '/contacts', component: Contacts }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
