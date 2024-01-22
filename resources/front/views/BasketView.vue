<template>
  <div class="container basket">
    <button class="basket__filter-btn">
      <SvgIcon name="back" />
      <span class="basket__filter-text">Спрятать фильтры</span>
    </button>
    <div class="basket__counter">
      <span>Корзина</span>
      <span class="basket__number">{{ store.cartSize }}</span>
    </div>
    <div class="basket__content">
      <div class="basket__inner">
        <div class="basket__card-head">
          <label for="test" class="basket__check-label">
            <input id="test" type="checkbox" v-model="isCheckAll" class="basket__check-input" />
            <span class="basket__check-box"></span>
            <SvgIcon name="checked" class="basket__check-svg" />
            <span>Выбрать всё</span>
          </label>
          <button class="basket__filter-btn" @click="deleteAllCheck">
            <span class="basket__filter-text">Удалить выбранные</span>
          </button>
        </div>
        <div class="basket__cards">
          <div v-for="cart in store.carts" :key="cart.id" class="basket__card">
            <label :for="cart.id" class="basket__check-label basket__check-label--card">
              <input :id="cart.id" type="checkbox" class="basket__check-input" :checked="cart.check" @change="(e) => handleChechCart(e, cart)"/>
              <span class="basket__check-box"></span>
              <SvgIcon name="checked" class="basket__check-svg" />
            </label>
            <img src="../../images/img/card.png" alt="" class="basket__card-img">
            <div class="basket__card-body">
              <div class="basket__card-desc">
                <p>{{ cart.title }}</p>
                <span class="basket__card-sku">Артикул: 320588</span>
              </div>
              <select name="" id="" class="basket__card-select">
                <option v-for="i in cart.qty" :key="i" :value="i">{{ i }}</option>
              </select>
              <div class="basket__card-counter">
                <SvgIcon name="plus" @click="store.incrementCartQty(cart)"/>
                <input type="text" :value="cart.qty">
                <SvgIcon name="minus" @click="store.decrementCartQty(cart)" :style="{ paddingTop:'10px', height:'20px'}"/>
              </div>
              <div class="basket__card-prices">
                <span>{{ cart.price }} {{ ' ' }} ₽</span>
                <span>{{ cart.price_old }}</span>
              </div>
              <div class="basket__card-icons">
                <SvgIcon name="favorite"/>
                <SvgIcon name="close-cart" @click="store.removeFormCarts(cart)"/>
              </div>
            </div>
          </div>
        </div>
        <form class="basket__form">
          <h4 class="basket__form-title">Покупатель</h4>
          <div class="basket__form-control">
            <label for="phone" class="basket__form-label">Телефон</label>
            <input id="phone" type="text" class="basket__form-input" placeholder="+ 7 (999) 888-77-66">
          </div>
          <div class="basket__form-control">
            <label for="name" class="basket__form-label">Имя</label>
            <input id="name" type="text" class="basket__form-input" placeholder="Ваше имя">
          </div>
          <div class="basket__form-control">
            <label for="email" class="basket__form-label">E-mail</label>
            <input id="email" type="text" class="basket__form-input" placeholder="E-mail">
          </div>
          <label for="te" class="basket__check-label">
            <input id="te" type="checkbox" class="basket__check-input" />
            <span class="basket__check-box"></span>
            <SvgIcon name="checked" class="basket__check-svg" />
            <span>Заказ получит другой человек</span>
          </label>
        </form>
      </div>
      <div class="basket__payment">
        <h4 class="basket__title">
          <span>К оплате</span>
          <span>{{ store.totalPrice }} ₽ </span>
        </h4>
        <ul class="basket__payment-list">
          <li class="basket__payment-item">
            <span>1 товар на сумму</span>
            <span></span>
            <span>23 980 ₽</span>
          </li>
          <li class="basket__payment-item">
            <span>скидка</span>
            <span></span>
            <span>7 000 ₽
              <SvgIcon name="question" class="basket__quest-svg" />
            </span>
          </li>
          <li class="basket__payment-item">
            <span>доставка</span>
            <span></span>
            <span>0 ₽
              <SvgIcon name="question" class="basket__quest-svg" />
            </span>
          </li>
        </ul>
        <input type="text" class="basket__input" placeholder="Ввести промокод">
        <button class="basket__btn">Добавить в корзину</button>
      </div>
    </div>
    <div class="basket__products">
      <h2 class="basket__prod-title">Похожие украшения</h2>
      <div class="basket__prod-inner">
        <div class="basket__prod-item" v-for="i in 4" :key="i"><Card/></div>
      </div>
    </div>
    <div class="basket__products">
        <h2 class="basket__prod-title">С этим товаром покупают</h2>
        <div class="basket__prod-inner">
          <div class="basket__prod-item" v-for="i in 4" :key="i"><Card/></div>
        </div>
      </div>
  </div>
</template>

<script setup>
  import {watch, ref} from 'vue'
  import Card from '../components/Card.vue';
  import SvgIcon from '../components/SvgIcon.vue';
  import { useProductStore } from '../store';
  
  const store = useProductStore();
  const isCheckAll = ref(localStorage.getItem("checkAll") || false);
  const handleChechCart = (e ,prod) => {
    // console.log(prod);
    // console.log(e.target.checked)
    prod.check = e.target.checked;
    store.toggleCheckCart(prod)
}

  const deleteAllCheck = () => {
    store.removeAllCheckFromCarts()
    isCheckAll.value = false;
    localStorage.setItem("checkAll", false);
  }

  watch(isCheckAll,(val) => {
    if (val) {
      store.checkAll()
    } else {
      store.unCheckAll()
    }
    localStorage.setItem("checkAll", val);
  })


</script>

<style lang="scss" scoped>
.basket {
  border-top: 1px solid #667080;
  padding-top: 20px;

  &__filter-btn {
    all: unset;
    border: none;
    outline: none;
    font-family: Inter;
    font-size: 12px;
    font-weight: 400;
    display: flex;
    align-items: center;
    column-gap: 12px;
    cursor: pointer;
    
  }

  &__filter-text {
    border-bottom: 1px solid #667080;
  }

  &__counter {
    font-size: 28px;
    font-weight: 600;
    line-height: 50px;
    display: flex;
    align-items: center;
    column-gap: 15px;
    margin-bottom: 21px;
  }

  &__number {
    font-size: 26px;
    font-weight: 400;
    color: #31363F;
    margin-top: 6px;
  }

  &__content {
    display: flex;
    column-gap: 60px;
    margin-bottom: 75px;
  }

  &__inner {
    flex: 1 1 100%;
  }

  &__payment {
    flex: 0 0 372px;
    background: #F1F5F8;
    padding: 36px 30px 20px 30px;
    margin-bottom: 40px;
    align-self: flex-start;
  }

  &__title {
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #31363F;
    margin-bottom: 28px;

    &:last-child {
      font-size: 24px;
      font-weight: 500;
      line-height: 40px;
      letter-spacing: 0em;
      text-align: left;
    }
  }

  &__payment-list {
    display: flex;
    flex-direction: column;
    gap: 11px;
    margin-bottom: 30px;
  }

  &__payment-item {
    font-size: 12px;
    font-weight: 500;
    line-height: 17px;
    display: flex;
    align-content: flex-end;
    column-gap: 10px;
    span:nth-child(1) {
      flex-shrink: 0;
      flex-grow: 0;
    }

    span:nth-child(2) {
      flex: 1 1 100%;
      border-bottom: .6px dashed #31363F;
      transform: translateY(-5px);

    }

    span:nth-child(3) {
      flex-shrink: 0;
      flex-grow: 0;
    }
  }

  &__quest-svg {
    transform: translateY(4px);
  }

  &__input {
    border: none;
    outline: none;
    display: block;
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #667080;
    border-radius: 10px;
    background-color: #F1F5F8;
    margin-bottom: 15px;

    &::placeholder {
      font-family: Inter;
      font-size: 14px;
      font-weight: 400;
      line-height: 27px;
      color: #667080;
    }

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
  }

  &__check-label {
    display: flex;
    align-items: center;
    column-gap: 6px;
    cursor: pointer;
    &--card {
      align-self: flex-start;
      margin-right: 15px;
    }
  }

  &__check-box {
    height: 18px;
    width: 18px;
    border: 1px solid #667080;
    border-radius: 5px;
  }

  &__check-svg {
    display: none;
  }
  &__check-input {
    display: none;

    &:checked~.basket__check-svg {
      display: block;
    }

    &:checked~.basket__check-box {
      display: none;
    }
  }

  &__card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    //border: 1px solid red;
    padding-bottom: 9px;
    
  }
  &__cards {
    border-bottom: 1px solid #EEF1F4;
    border-top: 1px solid #EEF1F4;
    padding-top: 15px;
    padding-bottom: 20px;
    margin-bottom: 40px;
  }
  &__card {
    display: flex;
    margin-bottom: 15px;
  }
  &__card-body {
    display: flex;
    align-items: center;
    width: 100%;
  }
  &__card-img {
    width: 100px;
    margin-right: 40px;
  }
  &__card-desc {
    font-size: 14px;
    font-weight: 500;
    line-height: 20px;
    margin-bottom: 10px;
    width: 154px;
    margin-right: 69px;
  }
  &__card-sku {
    font-size: 12px;
    font-weight: 400;
    line-height: 20px;
  }
  &__card-select {
    margin-right: 79px;
    border: none;
    outline: none;
  }
  &__card-counter {
    display: flex;
    align-items: center;
    margin-right: 99px;
    input {
      border: none;
      outline: none;
      font-family: Inter;
      font-size: 15px;
      font-weight: 500;
      line-height: 20px;
      color:#667080;
      width: 35px;
      text-align: center;
    }
    input::placeholder {
      color:#667080;
      font-size: 15px;
      font-weight: 500;
    }
  }
  &__card-prices {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-right: auto;
    font-size: 18px;
    font-weight: 500;
    line-height: 20px;
    span {
      &:nth-child(2) {
        text-decoration: line-through;
        font-weight: 400;
        color:#667080;
      }
    }
  }
  &__card-icons {
    display: flex;
    align-items: center;
    //margin-left: auto;
    column-gap: 20px;
  }
  &__form {

  }
  &__form-title {
    font-size: 18px;
    font-weight: 500;
    line-height: 22px;
    letter-spacing: -0.02em;
    margin-bottom: 25px;
  }
  &__form-control {
    display: flex;
    flex-direction: column;
    gap: 2px;
    margin-bottom: 20px;
  }
  &__form-label {
    font-size: 15px;
    font-weight: 500;
    line-height: 18px;
    letter-spacing: -0.02em;
  }
  &__form-input {
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    letter-spacing: -0.02em;
    color: #667080;
    width: 350px;
    padding: 12px 16px;
    border-radius: 10px;
    background: #EEF1F4;
    &::placeholder {
      font-size: 16px;
      font-weight: 400;
      line-height: 22px;
      letter-spacing: -0.02em;
      color: #667080;
    }
  }
  &__products {
    margin-bottom: 30px;
  }
  &__prod-title {
    font-size: 20px;
    font-weight: 600;
    line-height: 27px;
    text-align: center;
    margin-bottom: 20px;
  }
  &__prod-inner {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
    row-gap: 20px;
  }
  &__prod-item {
    width: 25%;
    padding-left: 10px;
    padding-right: 10px;
  }
}
</style>