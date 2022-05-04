import { createWebHistory, createRouter } from "vue-router";
import App from "./../App.vue";
import ProductList from "./../views/ProductList.vue";
import ProductCreate from "./../views/ProductCreate.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: ProductList,
  },
  {
    path: "/add-product",
    name: "products/create",
    component: ProductCreate
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;