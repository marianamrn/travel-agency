<template>
  <div id="app">
    <menu-component />
    <router-view />
  </div>
</template>

<script>
import Menu from './components/menu.vue';

export default {
  components: {
    'menu-component': Menu
  }
};
</script>

<style scoped>
</style>
