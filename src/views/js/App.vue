<template>
  <div class="container mt-5">
    <router-view />
  </div>
</template>

<script>
import ProductCreate from "./views/ProductCreate.vue";

export default {
  components: {
    ProductCreate
  },
  data() {
    return {
      message: 'Hello World',
    };
  },
};
</script>

<style>
.router-link:hover {
  color: white !important;
}
</style>