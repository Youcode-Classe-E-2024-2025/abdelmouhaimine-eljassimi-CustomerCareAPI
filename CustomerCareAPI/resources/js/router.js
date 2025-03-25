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
    {
        path: "/createTicket",
        component: () => import("../views/createTicket.vue"),
    },
    {
        path:'/ticket-details/:id',
        name: 'TicketDetails',
        component: () => import("../views/TicketDetails.vue"),
        props: true,
    },

];

export default createRouter({
    history: createWebHistory(),
    routes,
});
