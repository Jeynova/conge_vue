import { createRouter, createWebHistory } from "vue-router";

const routes = [
    { path: "/", component: () => import("./views/UserDashboard.vue") },
    { path: "/profile", component: () => import("./views/Profile.vue") },
    { path: "/admin", component: () => import("./views/AdminDashboard.vue") },
];

const router = createRouter({
    history: createWebHistory(), // Utilise le mode "history"
    routes,
});

export default router;