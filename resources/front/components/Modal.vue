<template>
  <div class="modal" :class="{hide: isAuth}">
    <div class="modal__inner">
      <form class="modal__form" @submit.prevent="handleSubmit">
        <h4 class="modal__form-title">Вход или регистрация</h4>
        <div class="modal__form-control">
          <label for="tel" class="modal__form-label">Телефон</label>
          <input id="tel" type="tel" class="modal__form-input" placeholder="+ 7 (___) ___-__-__" autocomplete="off">
        </div>
        <div class="modal__form-control">
          <!-- <label for="name" class="modal__form-label">Имя</label> -->
          <input  type="password" class="modal__form-input error" placeholder="Пароль" autocomplete="off">
        </div>
        <div class="modal__error-msg">Неверный пароль</div>
        <button class="modal__btn" type="submit">Войти</button>
        <SvgIcon name="close-login" class="modal__svg-close"/>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import SvgIcon from './SvgIcon.vue';
const isAuth = ref(true);
const phone = ref("");
const pass = ref("")

const handleSubmit = () => { isAuth.value = true;  }
  
  
</script>

<style lang="scss" scoped>
  .modal {
    background: rgba(#667080, .3);
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    
    &.hide {
      display: none;
    }
    &__inner {
      width: 417px;
      height: 355px;
      background: #ffffff;
      border-radius: 10px;
      padding: 35px;
      position: relative;
    }
    &__form-title {
      font-size: 20px;
      font-weight: 700;
      line-height: 24px;
      letter-spacing: -0.02em;
      margin-bottom: 24px;
    }
    
    &__form-control {
      display: flex;
      flex-direction: column;
      gap: 2px;
      margin-bottom: 15px;
    }
    &__form-label {
      font-size: 15px;
      font-weight: 700;
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
      &.error {
        //position: absolute;
        left: 0;
        //bottom: 20px;
        border: 1px solid #CC383C;
      }
    }
    &__error-msg {
      font-size: 13px;
      font-weight: 400;
      line-height: 20px;
      color:#CC383C;
      transform: translateY(-12px);
    }
    &__btn {
      all: unset;
      border: none;
      height: 46px;
      width: 100%;
      display: block;
      font-size: 14px;
      border-radius: 7px;
      text-align: center;
      line-height: 46px;
      color: #667080;
      background: #EEF1F4;
      margin-top: 20px;
      cursor: pointer;
      &:hover, &:active {
        background: #E2E7EE;
        color: #667080;
      }
    }
    &__svg-close {
      position: absolute;
      top: 15px;
      right: 15px;
    }
  }

</style>