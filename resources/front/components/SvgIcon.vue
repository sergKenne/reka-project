<script setup>
import { defineAsyncComponent } from 'vue';

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
});

const icon = defineAsyncComponent(() =>
  import(`../../images/svg/${props.name}.svg`)
);
</script>

<template>
  <component :is="icon" class="fill-current" />
</template>

<style lang="scss" scoped>
  .fill-current {
    cursor: pointer;
  }
</style>