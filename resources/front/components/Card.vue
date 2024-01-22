<template>
  <div class="card">
    <img src="../../images/img/card.png" alt="card" class="card__img">
    <div class="card__body">
      <div class="card__prices">
        <span>{{ product?.price }} {{'  '}}₽</span>
        <span class="card__old-price">{{ product?.price_old ? product?.price_old : '' }}</span>
      </div>
      <p class="card__desc">{{ product?.title }}</p>
      <button class="card__btn" @click="store.addToCarts(product)">Добавить в корзину</button>
    </div>
  </div>
</template>

<script setup>
import { useProductStore } from "../store"
defineProps(['product'])
const store = useProductStore();

</script>

<style lang="scss" scoped>
  .card {
    &__img {
      display: block;
      width: 100%;
    }
    &__body {
      padding: 20px;
    }
    &__prices {
      font-size: 16px;
      font-weight: 500;
      line-height: 20px;
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 6px;
    }
    &__old-price {
      font-size: 16px;
      font-weight: 400;
      line-height: 20px;
      text-decoration: line-through;
      color: #667080;
    }
    &__desc {
      font-size: 14px;
      font-weight: 400;
      line-height: 20px;
      width: 191px;
      margin-bottom: 15px;
    }
    &__btn {
      all: unset;
      border: none;
      height: 42px;
      width: 100%;
      display: block;
      border-radius: 7px;
      text-align: center;
      line-height: 42px;
      color: #ffffff;
      background: #667080;
      cursor: pointer;
      &:hover {
        background: #7c8593;
      }
    }
  }
</style>