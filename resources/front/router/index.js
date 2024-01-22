import { createRouter, createWebHistory } from "vue-router";

import BasketView from '../views/BasketView.vue';
import CatalogView from '../views/CatalogView.vue';

const routes= [
  {
      path: "/",
      name: "home",
      redirect: "/catalog"
  },
  {
    path: "/catalog",
    name: "catalog",
    component: CatalogView,
  },
  {
    path: "/basket",
    name: "basket",
    component: BasketView,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  // mode: "hash",
});


export default router;
