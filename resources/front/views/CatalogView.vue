<template>
	<div class="catalog">
		<Banner />
		<div v-if="isLoading"><Loading/></div>
		<div v-else>
			<h2 class="container catalog__header">Все изделия <span class="catalog__header-span">3 385 товаров</span></h2>
				<div  class="container catalog__inner">
				<div class="catalog__aside">
					<button class="catalog__filter-btn" @click="isToggleFilter = !isToggleFilter">
						<SvgIcon name="filter" />
						<span class="catalog__filter-text">Спрятать фильтры</span>
					</button>
					<div v-if="isToggleFilter">
						<drop-down title="Тип изделия">
							<ul class="catalog__prod-type-list">
								<li class="catalog__prod-type-item active">Все категории</li>
								<li 
									v-for="(value, key) in categories" 
									:key="key" 
									@click="store.toggleCategoriesFilter(value)"
									class="catalog__prod-type-item"
								>
									{{ value }}
								</li>
								{{ store.materialsFilters }}
							</ul>
						</drop-down>
						<drop-down title="Цена">
							<RangeSlider />
						</drop-down>
						<drop-down title="Материал">
							<CheckBoxs  
								v-for="material in store.data?.filters?.materials" 
								:key="material.id"
								:material="material"
							/>
						</drop-down>
						<div class="catalog__info">
							<CheckToggle 
								v-for="(tag, key) in store.data?.filters?.tags"
								:key="key"
								:tag="tag"
							/>
						</div>
						<button class="catalog__btn">Очистить фильтр</button>
					</div>
				</div>
				<div class="catalog__content">
					<ul class="catalog__filter-list">
						<li class="catalog__filter-item active">
							<span>Все категории</span>
							<SvgIcon name="close" />
						</li>

						<li v-for="elt in store.categoriesFilters" :key="elt" class="catalog__filter-item active">
							<span>{{ elt }}</span>
							<SvgIcon name="close" @click="store.removeFromFilter(elt)"/>
						</li>

						<li class="catalog__filter-item" @click="store.resetCatFilter()">
							<span>Сбросить все</span>
						</li>
					</ul>
					<div class="catalog__products">
						<div class="catalog__product" v-for="product in productsAfterFilter(store.categoriesFilters ,products) " :key="product.id">
							<Card :product="product" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import Loading from '../components/Loading.vue';
import Banner from '../components/Banner.vue';
import DropDown from '../components/DropDown.vue';
import RangeSlider from '../components/RangeSlider.vue';
import CheckBoxs from '../components/CheckBoxs.vue';
import CheckToggle from '../components/CheckToggle.vue';
import SvgIcon from '../components/SvgIcon.vue';
import Card from '../components/Card.vue'
import { onMounted, ref, toRefs } from 'vue';
import { useProductStore } from '../store'
import { storeToRefs } from 'pinia';

const isToggleFilter = ref(true)
const store = useProductStore();
const { products, categories, isLoading } = storeToRefs(store);

const productsAfterFilter = (arr, products) => {
	let newProdsFilter = [];
	if (arr.length == 0) {
		newProdsFilter = products;
	} else {
		products?.forEach(product => {
			newProdsFilter = arr.includes(product.category.title) ? [...newProdsFilter, product] : newProdsFilter;
		})
	}
	return newProdsFilter;
}

onMounted(() => {
	store.fetchData();
});

</script>

<style lang="scss" scoped>
.catalog {
	&__header {
		display: flex;
		align-items: center;
		font-size: 28px;
		font-weight: 600;
		line-height: 50px;
		gap: 10px;
		margin-top: 30px;
		margin-bottom: 12px;
		line-height: 50px;
	}

	&__header-span {
		font-size: 11px;
		font-weight: 400;
		line-height: 20px;
		margin-top: 8px;
	}

	&__inner {
		display: flex;
		column-gap: 70px;
		//border: 2px solid green;
	}

	&__aside {
		flex: 0 0 213px;
		//border: 2px solid blue;
	}

	&__filter-btn {
		all: unset;
		border: none;
		outline: none;
		font-family: Inter;
		font-size: 12px;
		font-weight: 400;
		//line-height: 24px;
		display: flex;
		align-items: center;
		column-gap: 12px;
		cursor: pointer;
		margin-bottom: 30px;
	}

	&__filter-text {
		border-bottom: 1px solid #667080;
	}

	&__prod-type-list {
		margin-top: 15px;
	}

	&__prod-type-item {
		padding: 5px 20px;
		font-size: 14px;
		font-weight: 400;
		line-height: 22px;
		cursor: pointer;
		&:hover {
			border-radius: 10px;
			background: #eef0f2;
		}

		&.active {
			border-radius: 10px;
			background: #EEF1F4;
		}
	}

	&__info {
		display: flex;
		flex-direction: column;
		gap: 9px;
		margin-bottom: 30px;
		margin-top: 30px;
	}

	&__btn {
		all: unset;
		border: none;
		border-bottom: 1px solid #667080;
		cursor: pointer
	}

	&__content {
		flex: 1 1 100%;
		//border: 2px solid red;
	}

	&__filter-list {
		display: flex;
		margin-bottom: 20px;
		column-gap: 6px;
	}

	&__filter-item {
		cursor: pointer;
		padding: 4px 8px;
		display: flex;
		align-items: center;
		font-size: 13px;
		font-weight: 400;
		border-radius: 16px;
		&.active {
			background: #EEF1F4;
		}
	}

	&__products {
		display: flex;
		flex-wrap: wrap;
		margin-left: -10px;
		margin-right: -10px;
	}

	&__product {
		width: 33.333%;
		min-height: 200px;
		//background: #adc;
		//border: 1px solid blue;
		padding-left: 10px;
		padding-right: 10px;
		margin-bottom: 20px;
	}
}
</style>