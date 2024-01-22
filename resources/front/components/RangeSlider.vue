<template>
  <div class="wrapper">
    <div class="price-input">
      <div class="field">
        <span>От</span>
        <input type="number" value="300" class="min-input" />
      </div>
      <div class="field">
        <span>До</span>
        <input type="number" value="3500" class="max-input" />
      </div>
    </div>
    <div class="slider">
      <div class="progress"></div>
    </div>
    <div class="range-input">
      <input type="range" min="0" max="10000" value="300" class="min-range" />
      <input
        type="range"
        min="0"
        max="10000"
        value="3500"
        class="max-range"
      />
    </div>
  </div>

</template>

<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "../store";
//const props = defineProps(['prices'])
const store = useProductStore()

const min = ref(null)
const max = ref(null)
  

onMounted(() => {

  // min.value = 300;
  // max.value = 3500;

  min.value = store.data?.base_filters.prices[0];
  max.value = store.data?.base_filters.prices[1];

  console.log("min:", min.value);
  console.log("max:", max.value);
    
    const priceInputs = document.querySelectorAll(".price-input input");
    const rangeInputs = document.querySelectorAll(".range-input input");
    const range = document.querySelector(".slider .progress");

    let priceGap = 1000;

    priceInputs.forEach((input) => {
      input.addEventListener("input", (e) => {
        let minPrice = parseInt(priceInputs[0].value);
        let maxPrice = parseInt(priceInputs[1].value);

        if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInputs[1].max) {
          if (e.target.className === "min-input") {
            rangeInputs[0].value = minPrice;
            range.style.left = (minPrice / rangeInputs[0].max) * 100 + "%";
          } else {
            rangeInputs[1].value = maxPrice;
            range.style.right = 100 - (maxPrice / rangeInputs[1].max) * 100 + "%";
          }
        }
      });
    });

    rangeInputs.forEach((input) => {
      input.addEventListener("input", (e) => {
        let minVal = parseInt(rangeInputs[0].value);
        let maxVal = parseInt(rangeInputs[1].value);

        min.value = minVal;
        max.value = maxVal;

        if (maxVal - minVal < priceGap) {
          if (e.target.className === "min-range") {
            rangeInputs[0].value = maxVal - priceGap;
          } else {
            rangeInputs[1].value = minVal + priceGap;
          }
        } else {
          priceInputs[0].value = minVal;
          priceInputs[1].value = maxVal;
          range.style.left = (minVal / rangeInputs[0].max) * 100 + "%";
          range.style.right = 100 - (maxVal / rangeInputs[1].max) * 100 + "%";
        }
      });
    });
    
  
  })
</script>

<style lang="scss" scoped>
  .wrapper {
    width: 145px;
  }

  .wrapper .price-input {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-bottom: 10px;
    margin-top: 15px;
  }

  .wrapper .price-input .field {
    display: flex;
    width: 100%;
    height: 45px;
    align-items: center;
  }

  .price-input .field {
    display: flex;
    align-items: center;
    column-gap: 7px;
    border: 1px solid #667080;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 5px;
    font-size: 15px;
    font-weight: 400;
    line-height: 20px;
  }

  .price-input input {
    outline: none;
    border: none;
    color: #667080;
    font-size: 15px;
    margin-top: 2px;
    width: 100%;
  }

  .price-input input::-webkit-outer-spin-button,
  .price-input input::-webkit-inner-spin-button {
    display: none;
  }

  .wrapper .seperator {
    width: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
  }

  .wrapper .slider {
    height: 1px;
    position: relative;
    background-color: #667080;
    border-radius: 1px;
  }

  .wrapper .progress {
    position: absolute;
    height: 100%;
    left: 5%;
    right: 65%;
    background-color: #667080;
    border-radius: 5px;
  }

  .wrapper .range-input {
    position: relative;
    margin-bottom: 20px;
  }

  .wrapper .range-input input {
    position: absolute;
    width: 100%;
    height: 5px;
    top: -4px;
    pointer-events: none;
    background: none;
    appearance: none;
    accent-color: #667080;
  }

  .wrapper .range-input input::-webkit-slider-thumb {
    height: 15px;
    width: 15px;
    background-color: #667080;
    border-radius: 50%;
    pointer-events: auto;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
  }
</style>