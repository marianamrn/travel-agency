// src/router.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import AboutUs from './components/AboutUs.vue';
import Tours from './components/Tours.vue';
import Excursions from './components/Excursions.vue';
import Hotels from './components/Hotels.vue';
import Contacts from './components/Contacts.vue';
import Login from './components/Login.vue';
import MyProfile from './components/MyProfile.vue';
import Register from './components/Register.vue'; 
import TourDetail from './components/TourDetail.vue'; 
import TourReservation from './components/TourReservation.vue';
import ExcursionDetail from './components/ExcursionDetail.vue'; 
import ExcursionReservation from './components/ExcursionReservation.vue';
import HotelDetail from './components/HotelDetail.vue'; 
import HotelReservation from './components/HotelReservation.vue';
import NewsDetail from './components/NewsDetail.vue'; 

const routes = [
  { path: '/', component: Home },
  { path: '/about-us', component: AboutUs },
  { path: '/tours', component: Tours },
  { path: '/excursions', component: Excursions },
  { path: '/hotels', component: Hotels },
  { path: '/contacts', component: Contacts },
  { path: '/login', component: Login },
  { path: '/myprofile', component: MyProfile },
  { path: '/register', component: Register },
  { path: '/tour/:id', component: TourDetail, props: true },
  { path: '/reserveTours/:id', component: TourReservation, props: true },
  { path: '/excursion/:id', component: ExcursionDetail, props: true },
  { path: '/reserveExcursions/:id', component: ExcursionReservation, props: true },
  { path: '/hotel/:id', component: HotelDetail, props: true },
  { path: '/hotelReservation/:id', component: HotelReservation, props: true },
  { path: '/news/:id', component: NewsDetail, props: true } 
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
