<template>
  <div class="banner">
    <div>
      <h1 class="banner__title">Все категории</h1>
      <p class="banner__desc">Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. </p>
    </div>
    <SvgIcon name="banner" class="banner__logo"/>
  </div>
</template>

<script setup>
import SvgIcon from './SvgIcon.vue';

</script>

<style lang="scss" scoped>
@import '../../css/global.scss';
  .banner {
    background: #EEF1F4;
    height: 357px;
    padding-left: 170px;
    padding-right: 170px;
    display: flex;
    justify-content: space-between;
    &__title {
      font-size: 30px;
      font-weight: 600;
      line-height: 36px;
      letter-spacing: -0.02em;
      color: #31363F;
      margin-bottom: 15px;
      margin-top: 96px;
    }
    &__desc {
      font-size: 15px;
      line-height: 22px;
      width: 440px;
    }
    &__logo {
      margin-top: 61px;
    }
  }
</style>