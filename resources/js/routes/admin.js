//dashboard imports
import DashboardPage from "./../pages/admin/dashboard/DashboardPage.vue";
//user imports
import UserPage from "./../pages/admin/users/index/UserPage.vue";
import CreateUser from "./../pages/admin/users/create/CreateUser.vue";
import EditUser from "./../pages/admin/users/edit/EditUser.vue";
// settings imports
import SettingPage from "./../pages/admin/settings/SettingPage.vue";

const admin = [
    ////////////////////////////////// admin routes ////////////////////////////
    // //dashboard
    // {
    //     name: "admin.dashboard",
    //     path: "dashboard",
    //     component: DashboardPage,
    // },
    // users
    {
        name: "admin.users",
        path: "users",
        component: UserPage,
        props: true,
    },
    {
        name: "admin.users.create",
        path: "users/add",
        component: CreateUser,
        props: true,
    },
    {
        name: "admin.users.edit",
        path: "users/edit",
        component: EditUser,
        props: true,
    },
    //settings
    {
        name: "admin.settings",
        path: "settings",
        component: SettingPage,
    },
    //////////////////////////////// static dashboard routes ////////////////////////////
    {
        path: "dashboard",
        name: "admin.dashboard",
        component: () => import("../pages/admin/Dashboard.vue"),
    },
    {
        path: "uikit/formlayout",
        name: "admin.formlayout",
        component: () => import("../components/uikit/FormLayout.vue"),
    },
    {
        path: "uikit/input",
        name: "admin.input",
        component: () => import("../components/uikit/Input.vue"),
    },
    {
        path: "uikit/floatlabel",
        name: "admin.floatlabel",
        component: () => import("../components/uikit/FloatLabel.vue"),
    },
    {
        path: "uikit/invalidstate",
        name: "admin.invalidstate",
        component: () => import("../components/uikit/InvalidState.vue"),
    },
    {
        path: "uikit/button",
        name: "admin.button",
        component: () => import("../components/uikit/Button.vue"),
    },
    {
        path: "uikit/table",
        name: "admin.table",
        component: () => import("../components/uikit/Table.vue"),
    },
    {
        path: "uikit/list",
        name: "admin.list",
        component: () => import("../components/uikit/List.vue"),
    },
    {
        path: "uikit/tree",
        name: "admin.tree",
        component: () => import("../components/uikit/Tree.vue"),
    },
    {
        path: "uikit/panel",
        name: "admin.panel",
        component: () => import("../components/uikit/Panels.vue"),
    },

    {
        path: "uikit/overlay",
        name: "admin.overlay",
        component: () => import("../components/uikit/Overlay.vue"),
    },
    {
        path: "uikit/media",
        name: "admin.media",
        component: () => import("../components/uikit/Media.vue"),
    },
    {
        path: "uikit/menu",
        component: () => import("../components/uikit/Menu.vue"),
        children: [
            {
                path: "uikit/menu",
                name: "admin.menu",
                component: () =>
                    import("../components/uikit/menu/PersonalDemo.vue"),
            },
            {
                path: "uikit/menu/seat",
                name: "admin.menu.seat",
                component: () =>
                    import("../components/uikit/menu/SeatDemo.vue"),
            },
            {
                path: "uikit/menu/payment",
                name: "admin.menu.payment",
                component: () =>
                    import("../components/uikit/menu/PaymentDemo.vue"),
            },
            {
                path: "uikit/menu/confirmation",
                name: "admin.menu.confirmation",
                component: () =>
                    import("../components/uikit/menu/ConfirmationDemo.vue"),
            },
        ],
    },
    {
        path: "uikit/message",
        name: "admin.message",
        component: () => import("../components/uikit/Messages.vue"),
    },
    {
        path: "uikit/file",
        name: "admin.file",
        component: () => import("../components/uikit/File.vue"),
    },
    {
        path: "uikit/charts",
        name: "admin.charts",
        component: () => import("../components/uikit/Chart.vue"),
    },
    {
        path: "uikit/misc",
        name: "admin.misc",
        component: () => import("../components/uikit/Misc.vue"),
    },
    {
        path: "blocks",
        name: "admin.blocks",
        component: () => import("../components/utilities/Blocks.vue"),
    },
    {
        path: "pages/timeline",
        name: "admin.timeline",
        component: () => import("../pages/admin/Timeline.vue"),
    },
    {
        path: "pages/empty",
        name: "admin.empty",
        component: () => import("../pages/admin/Empty.vue"),
    },
    {
        path: "pages/crud",
        name: "admin.crud",
        component: () => import("../pages/admin/Crud.vue"),
    },
    {
        path: "documentation",
        name: "admin.documentation",
        component: () => import("../components/utilities/Documentation.vue"),
    },
];

export default admin;
