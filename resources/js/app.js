import "./bootstrap";
import "flowbite";
import { createApp } from "vue";
import app from "./App.vue";
import store from "./store";
import router from "./router";

createApp(app).use(store).use(router).mount("#app");
