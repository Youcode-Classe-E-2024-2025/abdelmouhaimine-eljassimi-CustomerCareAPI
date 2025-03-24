import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("../views/login.vue"),
    },
    {
        path: "/register",
        component: () => import("../views/register.vue"),
    },
    {
        path: "/home",
        component: () => import("../views/home.vue"),
    },

];

export default createRouter({
    history: createWebHistory(),
    routes,
});
