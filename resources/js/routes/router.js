import { createRouter, createWebHistory } from "vue-router";

import WebLayout from "../layouts/WebLayout.vue";
import AdminLayout from "../layouts/AdminLayout.vue";
import AppLayout from "../layouts/Admin/AppLayout.vue";
import LoginPage from "./../pages/admin/auth/LoginPage.vue";
import NotFound from "./../components/user-interface/NotFound.vue";

import web from "./web";
import admin from "./admin";

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes: [
        {
            name: "web",
            path: "/",
            component: WebLayout,
            children: web,
            // redirect: { name: "admin.dashboard" }
            redirect: { name: "admin.dashboard" },
        },
        {
            name: "admin",
            path: "/admin",
            component: AppLayout,
            children: admin,
            // redirect: { name: "admin.dashboard" }
            redirect: { name: "admin.dashboard" },
        },
        // // admin auth
        // {
        //     name: "admin.login",
        //     path: "/admin/login",
        //     component: LoginPage,
        // },
        //not founded pages
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
            path: "/auth/login",
            name: "login",
            component: () => import("../pages/admin/auth-sakai/Login.vue"),
        },
        {
            path: "/auth/access",
            name: "accessDenied",
            component: () => import("../pages/admin/auth-sakai/Access.vue"),
        },
        {
            path: "/auth/error",
            name: "error",
            component: () => import("../pages/admin/auth-sakai/Error.vue"),
        },
    ],
});

export default router;
