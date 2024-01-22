<template>
  <div class="loading">
    <div class="loading__spinner"></div>
  </div>
</template>

<script setup>
import SvgIcon from "./SvgIcon.vue"

</script>

<style lang="scss" scoped>
  .loading {
    height: 30vh;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    &__spinner {
      width: 80px;
      height: 80px;
      border: 8px dotted #7b828f;
      border-radius: 100%;
      animation: rotate 2s linear  infinite;
    }
  }

  @keyframes rotate {   
    from {     
      transform: rotate(0deg);   
    }   
    to {
      transform: rotate(360deg);  
    }
  }
</style>