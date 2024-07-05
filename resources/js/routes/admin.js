const admin = [
    ////////////////////////////////// admin routes ////////////////////////////
    //dashboard
    {
        path: "dashboard",
        name: "admin.dashboard",
        component: () => import("../pages/admin/dashboard/DashboardPage.vue"),
    },
    // users
    {
        name: "admin.users",
        path: "users",
        component: () => import("../pages/admin/users/index/UserPage.vue"),
        props: true,
    },
    {
        name: "admin.users.create",
        path: "users/add",
        component: () => import("../pages/admin/users/create/CreateUser.vue"),
        props: true,
    },
    {
        name: "admin.users.edit",
        path: "users/edit",
        component: () => import("../pages/admin/users/edit/EditUser.vue"),
        props: true,
    },
    //settings
    {
        name: "admin.settings",
        path: "settings",
        component: () => import("../pages/admin/settings/SettingPage.vue"),
    },
];

export default admin;
