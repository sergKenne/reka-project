<template>
  <div class="footer">
    <div class="footer__content">
      <div class="container footer__inner">
        <router-link to="/" class="footer__logo">
          <SvgIcon name="logo"/>
        </router-link>
        <div class="footer__nav">
          <ul class="footer__nav-list">
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">О компании</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Магазины</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Новости</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Сотрудничество</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Контакты</router-link>
            </li>
          </ul>
          <ul class="footer__nav-list">
            <li class="footer__nav-title">Украшения</li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Кольца</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Подвески</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Цепи</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Серьги</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Золото</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Серебро</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Подарки</router-link>
            </li>
          </ul>
          <ul class="footer__nav-list">
            <li class="footer__nav-title">Инфоормация</li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Акции</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Скидки</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Лови удачу</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Доставка и оплата</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Гарантия и возврат</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Рассрочка</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Долями</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Отзывы</router-link>
            </li>
            <li class="footer__nav-item">
              <router-link to="/" class="footer__nav-link">Ломбард</router-link>
            </li>
          </ul>
        </div>
        <div class="footer__contact">
          <a href="tel:88005117730" class="footer__phone">8 (800) 511 77 30</a>
          <div class="footer__info">Бесплатно по России</div>
          <a href="email:info@logotip.com" class="footer__email">info@logotip.com</a>
          <div class="footer__social">
            <a href="#" class="footer__social-item"><SvgIcon name="ak"/></a>
            <a href="#" class="footer__social-item"><SvgIcon name="vk"/></a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__bottom">
      <ul class="container footer__bottom-list">
        <li class="footer__botton-item">© 2023 «Логотип». Все права защищены</li>
        <li class="footer__botton-item">Политика конфиденциальности</li>
        <li class="footer__botton-item">Разработано Reka digital.</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import SvgIcon from './SvgIcon.vue';

</script>

<style lang="scss" scoped>
  @import '../../css/global.scss';
  .footer {
    &__content {
      background: #F1F5F8;
      padding-top: 50px;
      padding-bottom: 50px;
    }
    &__inner {
      display: flex;
      justify-content: space-between;
    }
    &__nav {
      display: flex;
      column-gap: 140px;
    }
    &__nav-list {
      display: flex;
      flex-direction: column;
      gap: 10px
    }
    &__nav-title {
      font-size: 15px;
      font-weight: 500;
      line-height: 22px;
    }
    &__nav-link {
      font-size: 13px;
      font-weight: 400;
      line-height: 22px;
    }
    &__bottom-list {
      height: 46px;
      @include flex-space-between;
    }
    &__bottom {
      background: #ffffff;
    }
    &__bottom-item {
      font-size: 12px;
      line-height: 22px;
      letter-spacing: -0.02em;
    }
    &__phone {
      font-size: 18px;
      font-weight: 600;
      line-height: 22px;
    }
    &__info {
      font-size: 12px;
      font-weight: 400;
      line-height: 23px;
      margin-bottom: 15px;
    }
    &__email {
      font-size: 12px;
      font-weight: 400;
      line-height: 23px;
      
    }
    &__social {
      display: flex;
      column-gap: 20px;
      margin-top: 25px;
    }
  }
</style>