import { createRouter, createWebHistory } from "vue-router";

import AppLayout from "../layouts/Admin/AppLayout.vue";

import web from "./web";
import admin from "./admin";

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes: [
        // {
        //     name: "web",
        //     path: "/",
        //     component: WebLayout,
        //     children: web,
        //     redirect: { name: "web.home" },
        // },
        {
            name: "admin",
            path: "/admin",
            component: AppLayout,
            children: admin,
            // redirect: { name: "admin.dashboard" }
            redirect: { name: "admin.dashboard" },
        },
        {
            name: "notfound",
            path: "/:notfound(.*)",
            component: () => import("../pages/admin/NotFound.vue"),
        },
        ////////////////////////////////// static dashboard routes ////////////////////////////
        {
            path: "/landing",
            name: "landing",
            component: () => import("../pages/admin/Landing.vue"),
        },
        {
            path: "/admin/login",
            name: "login",
            component: () => import("../pages/admin/auth/Login.vue"),
        },
        {
            path: "/access-denied",
            name: "accessDenied",
            component: () => import("../pages/admin/auth/Access.vue"),
        },
        {
            path: "/error",
            name: "error",
            component: () => import("../pages/admin/auth/Error.vue"),
        },
    ],
});

export default router;
