import { createRouter, createWebHistory } from "vue-router";

import WebLayout from "../layouts/Web/WebLayout.vue";
import AppLayout from "../layouts/Admin/AppLayout.vue";

import web from "./web";
import admin from "./admin";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        // {
        //     name: "web",
        //     path: "/",
        //     component: WebLayout,
        //     children: web,
        //     redirect: { name: "web.home" },
        // },
        {
            name: "web",
            path: "/",
            // component: WebLayout,
            children: web,
            redirect: { name: "admin.dashboard" },
        },
        {
            name: "admin",
            path: "/admin",
            component: AppLayout,
            children: admin,
            redirect: { name: "admin.dashboard" },
        },
        // auth
        {
            path: "/admin/login",
            name: "admin.login",
            component: () => import("../pages/admin/auth/Login.vue"),
        },
        // access denied
        {
            path: "/access-denied",
            name: "access-denied",
            component: () => import("../pages/admin/auth/Access.vue"),
        },
        // error
        {
            path: "/error",
            name: "error",
            component: () => import("../pages/admin/auth/Error.vue"),
        },
        //not founded pages
        {
            name: "notfound",
            path: "/:notfound(.*)",
            component: () => import("../pages/NotFound.vue"),
        },        
    ],
});

export default router;
