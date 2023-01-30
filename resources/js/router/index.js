import { createRouter, createWebHistory } from "vue-router";
import DefaultLayout from "../components/Layouts/DefaultLayout.vue";
import Home from "../views/Home.vue";
import CreateAmv from "../views/CreateAmv.vue";
const routes = [
    {
        path: "/home",
        redirect: "/",
        component: DefaultLayout,
        children: [
            { path: "/", name: "Home", component: Home },
            { path: "/post-amv", name: "CreateAmv", component: CreateAmv },
        ],
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
