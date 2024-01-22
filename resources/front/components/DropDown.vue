<template>
  <div class="dropdown">
    <div class="dropdown__title" @click="isDrop=!isDrop">
      <span>{{ title }} </span>
      <SvgIcon name="down" class="dropdown__svg-icon" :class="{up: isDrop}"/>
    </div>
    <div class="dropdown__inner" :class="{hide:isDrop}">
       <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import SvgIcon from './SvgIcon.vue';
  defineProps({
    title: {
      type: String,
      required: true
    }
  })

  const isDrop = ref(false)
</script>

<style lang="scss" scoped>
  .dropdown {
    //margin-bottom: 10px;
    &__title {
      display: flex;
      align-items: center;
      column-gap: 4px;
      font-family: Inter;
      font-size: 16px;
      font-weight: 500;
      line-height: 20px;
      cursor: pointer;
      margin-bottom: 15px;
    }
    &__svg-icon {
      margin-top: 2px;
      transition: all .2s ease-in-out;
      &.up {
        transform: rotateZ(-180deg);
      }
    }
    &__inner {
      transform: scale(1);
      transition: all .2s ease-in-out;

      &.hide {
        height: 0px;
        overflow: hidden;
        transform: scale(0);
      }
    }
  }
</style>