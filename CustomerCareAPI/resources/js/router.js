import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("../views/login.vue"),
    },

];

export default createRouter({
    history: createWebHistory(),
    routes,
});
