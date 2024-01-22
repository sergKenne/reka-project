<template>
  <ul class="catalog__check-list">
    <li class="catalog__check-item">
      <label :for="material.id" class="catalog__check-label">
        <input :id="material.id" type="checkbox" class="catalog__check-input" v-model="checked" />
        <span class="catalog__check-box"></span>
        <SvgIcon name="checked" class="catalog__check-svg" />
        <span>{{ material.title }}</span>
        <SvgIcon name="down" class="catalog__check-down" :class="{ up: !checked }" />
      </label>
    </li>
    <ul class="catalog__check-sublist" :class="{ hide: !checked }">
      <li 
        v-for="material in material.materials" 
        :key="material.title" 
        class="catalog__check-subitem"
      >
        <label :for="material.title" class="catalog__check-label">
          <input 
            :id="material.title" 
            type="checkbox" 
            class="catalog__check-input" 
            @change="(e) => handleChange(e, material.title)"
           
          />
          <span class="catalog__check-box"></span>
          <SvgIcon name="checked" class="catalog__check-svg"  />
          <span>{{ material.title }}</span>
        </label>
      </li>
    </ul>
  </ul>
</template>

<script setup>
  import { ref, defineProps } from 'vue';
import { useProductStore } from '../store';
import SvgIcon from './SvgIcon.vue';
  defineProps(['material'])
const store = useProductStore();

  const checked = ref(true);
const handleChange = (e, material) => {
    if(e.target.checked) {
      store.addToMaterialFilter(material)
    } else {
      store.removeFromMaterialFilter(material)
    }
    console.log(e.target.checked);
    console.log(material);
  }

</script>

<style lang="scss" scoped>
  .catalog {
    &__check-list {
      margin-bottom: 15px;
    }
    //Check
	 &__check-sublist {
		padding-left: 24px;
		display: flex;
		flex-direction: column;
		gap: 11px;
    transform: scale(1);
    transition: all .2s ease-in-out;
    &.hide {
      height: 0px;
      overflow: hidden;
      transform: scale(0);
    }

	 }
   &__check-subitem {

   }
	 &__check-item {
		margin-bottom: 11px;
	 }
	 &__check-label {
		display: flex;
		align-items: center;
		column-gap: 6px;
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
   &__check-down {
    transition: all .2s ease-in-out;
    &.up {
      transform: rotateZ(-180deg);
    }
   }
	 &__check-input {
		display: none;
		&:checked ~ .catalog__check-svg {
			display: block;
		}
		&:checked ~ .catalog__check-box {
			display: none;
		}
	 }
  }
</style>