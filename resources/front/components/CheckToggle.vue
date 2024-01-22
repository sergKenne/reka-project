<template>
  <div class="wrapper">
    <span>{{ tag }}</span>
    <label class="toggle">
        <input type="checkbox">
        <span class="slider"></span>
    </label>
  </div>
  
</template>

<script setup>
defineProps(["tag"])

</script>

<style lang="scss" scoped>

  .wrapper {
    display: flex;
		align-items: center;
		justify-content: space-between;
    text-transform: capitalize;
    line-height: 20px;
  }
  

  .toggle {
      position: relative;
      display: inline-block;
      width: 22px;
      height: 8px;
      border-radius: 10px;
  }
    
  .toggle input {
      display: none;
  }
    
  /* Describe slider's look and position. */
  .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #bdc2cb;
      transition: .4s;
      border-radius: 34px;
  }
  .slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 0px;
      bottom: -4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
      border: 1px solid #bdc2cb;
  }
  input:checked+.slider {
      background-color: green;
  }
  input:checked+.slider:before {
      transform: translateX(7px);
  }
</style>