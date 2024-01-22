import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        isAuth: false,
    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        authorized() {
            this.isAuth = true;
            localStorage.setItem("isAuth", true);
        },
    },
});

export const useProductStore = defineStore("product", {
    state: () => ({
        data: null,
        isLoading: false,
        isError: "",
        carts: localStorage.getItem("carts")
            ? JSON.parse(localStorage.getItem("carts"))
            : [],
        categoriesFilters: localStorage.getItem("filterCategory")
            ? JSON.parse(localStorage.getItem("filterCategory"))
            : [],
        materialsFilters: localStorage.getItem("filterMaterial")
            ? JSON.parse(localStorage.getItem("filterMaterial"))
            : [],
    }),
    actions: {
        fetchData() {
            this.isLoading = true;
            fetch("http://127.0.0.1:8000/api/products")
                .then((data) => data.json())
                .then((response) => {
                    this.data = response;
                    this.isLoading = false;
                })
                .catch((err) => {
                    this.isError = "Something went wrong...";
                    this.isLoading = false;
                });
        },
        addToCarts(prod) {
            console.log(prod);
            const incart = this.carts.find((item) => item.id == prod.id);
            if (incart) {
                incart.qty += 1;
            } else {
                this.carts.push({ ...prod, qty: 1, check: false });
            }
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        removeFormCarts(prod) {
            this.carts = this.carts.filter((item) => item.id != prod.id);
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        removeAllCheckFromCarts() {
            this.carts = this.carts.filter((item) => !item.check);
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        checkAll() {
            this.carts = this.carts.map((item) => {
                item.check = true;
                return item;
            });
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        unCheckAll() {
            this.carts = this.carts.map((item) => {
                item.check = false;
                return item;
            });
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        toggleCheckCart(prod) {
            this.carts = this.carts.filter((item) =>
                item.id == prod.id ? prod : item
            );
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        incrementCartQty(prod) {
            this.carts = this.carts.filter((item) => {
                if (item.id == prod.id) {
                    item.qty += 1;
                    return item;
                } else {
                    return item;
                }
            });
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        decrementCartQty(prod) {
            this.carts = this.carts.filter((item) => {
                if (item.id == prod.id && prod.qty > 1) {
                    item.qty -= 1;
                    return item;
                } else {
                    return item;
                }
            });
            localStorage.setItem("carts", JSON.stringify(this.carts));
        },
        toggleCategoriesFilter(cat) {
            if (this.categoriesFilters.includes(cat)) {
                this.categoriesFilters = this.categoriesFilters.filter(
                    (el) => el != cat
                );
            } else {
                this.categoriesFilters.push(cat);
            }
            localStorage.setItem(
                "filterCategory",
                JSON.stringify(this.categoriesFilters)
            );
        },
        // toggleMaterialFilter(material) {
        //     if (this.categoriesFilters.includes(cat)) {
        //         this.categoriesFilters = this.categoriesFilters.filter(
        //             (el) => el != material
        //         );
        //     } else {
        //         this.categoriesFilters.push(material);
        //     }
        //     localStorage.setItem(
        //         "filterMaterial",
        //         JSON.stringify(this.materialsFilters)
        //     );
        // },
        addToMaterialFilter(material) {
					this.materialsFilters.push(material);
					localStorage.setItem(
							"filterMaterial",
							JSON.stringify(this.materialsFilters)
					);
        },
        removeFromMaterialFilter(material) {
					this.materialsFilters = this.materialsFilters.filter(el => el != material);
					localStorage.setItem(
                        "filterMaterial",
                        JSON.stringify(this.materialsFilters)
                    );
        },
        removeFromFilter(elt) {
            this.categoriesFilters = this.categoriesFilters.filter(
                (item) => item != elt
            );
            localStorage.setItem(
                "filterCategory",
                JSON.stringify(this.categoriesFilters)
            );
        },
        resetCatFilter() {
            this.categoriesFilters = [];
            localStorage.setItem("filterCategory", JSON.stringify([]));
        },
    },
    getters: {
        categories(state) {
            return state.data?.categories;
        },
        products(state) {
            return state.data?.data;
        },
        cartSize(state) {
            return state.carts.reduce((acc, curr) => acc + curr.qty, 0);
        },
        totalPrice(state) {
            return state.carts.reduce(
                (acc, curr) => acc + curr.price * curr.qty,
                0
            );
        },
        // baseFilterPrice(state) {
        // 		return state.data?.base_filters.prices
        // }
    },
});

