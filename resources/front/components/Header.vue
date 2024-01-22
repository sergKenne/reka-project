<template>
  <div class="header">
    <div class="container">
      <div class="header__top">
        <div class="header__top-info">
          <div class="header__top-address">
            <SvgIcon name="navigate"/>
            <span>Москва</span>
          </div>
          <a href="" class="header__top-phone">8 (800) 511 77 30</a>
        </div>
        <div class="header__top-nav">
          <a href="#" class="header__top-navlink">Оплата и доставка</a>
          <a href="#" class="header__top-navlink">Возврат и обмен</a>
          <a href="#" class="header__top-navlink">Подарочный сертификат</a>
        </div>
      </div>
      <div class="header__middle">
        <router-link to="/" class="header__logo" >
          <SvgIcon name="logo" />
        </router-link>
        <nav class="header__navbar">
          <ul class="header__nav-list">
            <li class="header__nav-item">
              <div class="header__nav-drop">
                <span>Каталог</span>
                <SvgIcon name="array" class="header__nav-svg-down"/>
              </div>
              <ul class="header_nav-subList">
                <li class="header__nav-subItem"></li>
                <li class="header__nav-subItem"></li>
                <li class="header__nav-subItem"></li>
              </ul>
            </li>
            <li class="header__nav-item">
              <router-link to="#" class="header__nav-link">Магазины</router-link>
            </li>
            <li class="header__nav-item">
              <router-link to="#" class="header__nav-link">Акции</router-link>
            </li>
            <li class="header__nav-item">
              <router-link to="#" class="header__nav-link">Розыгрыш</router-link>
            </li>
          </ul>
          <form action="" class="header__form">
            <input type="search" class="header__input" placeholder="Поиск по каталогу ">
            <button type="submit" class="header__input-icon">
              <SvgIcon name="search" />
            </button>
          </form>
        </nav>
        <div class="header__nav-icons">
          <router-link to="#" class="header__nav-link">
            <SvgIcon name="favorite" class="header__nav-svg"/>
          </router-link>
          <router-link to="/basket" class="header__nav-link header__nav-link--cart">
            <span v-if="store.cartSize>0" class="header__cart-size">{{ store.cartSize }}</span>
            <SvgIcon name="cart" class="header__nav-svg"/>
          </router-link>
          <router-link to="#" class="header__nav-link">
           <SvgIcon name="user" class="header__nav-svg"/> 
          </router-link>
        </div>
      </div>
      <ul class="header__categories">
        <li class="header__categorie-item">ВСЕ АКЦИИ</li>
        <li class="header__categorie-item">БРИЛЛИАНТЫ</li>
        <li class="header__categorie-item">SALE</li>
        <li class="header__categorie-item">ПОМОЛВОЧНЫЕ КОЛЬЦА</li>
        <li class="header__categorie-item">КОЛЬЦА С ФИАНИТОМ</li>
        <li class="header__categorie-item">ОБРУЧАЛЬНЫЕ КОЛЬЦА</li>
        <li class="header__categorie-item">БЕЛОЕ ЗОЛОТО</li>
        <li class="header__categorie-item">ПОДАРКИ К 8 МАРТА</li>
        <li class="header__categorie-item">БЕЛОЕ ЗОЛОТО</li>
        <li class="header__categorie-item">КОЛЬЦА С ФИАНИТОМ</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
  import { useProductStore } from '../store'
  import SvgIcon from './SvgIcon.vue'
  const store = useProductStore();

</script>

<style lang="scss" scoped>
  @import '../../css/global.scss';
  .header {

    &__top {
      @include flex-space-between;
      padding-top: 10px;
      margin-bottom: 18px;
    }
    &__top-info {
      @include flex-space-between;
      column-gap: 40px;
    }
    &__top-address {
      @include flex-space-between;
      gap: 2px;
    }
    &__top-phone {
      font-size: 13px;
    }
    &__top-nav {
      @include flex-space-between;
      font-size: 13px;
      column-gap: 40px;
    }
    &__top-navlink {
      font-size: 13px;
    }
    &__middle{
      @include flex-align-center;
      margin-bottom: 20px;
    }
    &__categories {
      @include flex-space-between;
      margin-bottom: 15px;
    }
    &__logo {
      
    }
    &__navbar {
      @include flex-align-center;
      border-left: 1px solid $main-color;
      border-right: 1px solid $main-color; 
      margin-left: 20px;
      margin-right: 20px;
      padding-left: 20px;
      padding-right: 20px;
    }
    &__nav-list {
      @include flex-space-between;
      column-gap: 30px;
      /* padding: 7px 20px; */
      margin-right: 30px;
    }
    &__nav-drop {
      @include flex-align-center;
      gap: 5px;
      cursor: pointer;
    }
    &__nav-svg-down {
      margin-top: 4px;
    }
    &__nav-link {
      font-weight: 500;
      text-transform: capitalize;
      line-height: 0px;
      &--cart {
        position: relative;
      }
    }
    &__cart-size {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      color: #ffffff;
      width: 24px;
      height: 24px;
      background: #667080;
      border-radius: 50%;
      top: -14px;
      right: -14px;
      font-size: 12px;

    }
    &__form {
      position: relative;
    }
    &__input {
      display: block;
      width: 608px;
      border: none;
      outline: none;
      padding: 7px 16px;
      border: 1px solid #EEF1F4;
      background: #EEF1F4;
      border-radius: 5px;
      line-height: 22px;
      height: 36px;
      color: #667080;
      font-weight: 400;
      font-size: 14px;
      &::placeholder{
        color: #667080;
        font-weight: 400;
        font-size: 14px;

      }
    }
    &__input-icon {
      all:unset;
      border: none;
      outline: none;
      position: absolute;
      right: 16px;
      top: 8px;
      cursor: pointer;
    }
    &__nav-icons {
      margin-left: auto;
      @include flex-align-center;
      column-gap: 25px;
    }
    &__nav-svg {

    }
    &__categorie-item {
      font-size: 11px;
      font-weight: 500;
      line-height: 20px;
    }
  }
</style>