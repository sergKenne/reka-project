
import { createApp } from "vue/dist/vue.esm-bundler";
import { createPinia } from "pinia";
import App from "@/App.vue";
import router from "./router";

const app = createApp(App);
const pinia = createPinia();

app.use(pinia);
app.use(router);
app.mount("#app");
