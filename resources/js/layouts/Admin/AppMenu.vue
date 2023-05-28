<script setup>
import { ref } from "vue";

import AppMenuItem from "./AppMenuItem.vue";

const model = ref([
    {
        label: "Home",
        items: [
            {
                label: "Dashboard",
                icon: "pi pi-fw pi-home",
                to: "/admin/dashboard",
                name: "admin.dashboard",
            },
        ],
    },
    {
        label: "UI Components",
        items: [
            {
                label: "Form Layout",
                icon: "pi pi-fw pi-id-card",
                to: "/admin/uikit/formlayout",
                name: "admin.formlayout",
            },
            {
                label: "Input",
                icon: "pi pi-fw pi-check-square",
                to: "/admin/uikit/input",
                name: "admin.input",
            },
            {
                label: "Float Label",
                icon: "pi pi-fw pi-bookmark",
                to: "/admin/uikit/floatlabel",
                name: "admin.floatlabel",
            },
            {
                label: "Invalid State",
                icon: "pi pi-fw pi-exclamation-circle",
                to: "/admin/uikit/invalidstate",
                name: "admin.invalidstate",
            },
            {
                label: "Button",
                icon: "pi pi-fw pi-mobile",
                to: "/admin/uikit/button",
                class: "rotated-icon",
                name: "admin.button",
            },
            {
                label: "Table",
                icon: "pi pi-fw pi-table",
                to: "/admin/uikit/table",
                name: "admin.table",
            },
            {
                label: "List",
                icon: "pi pi-fw pi-list",
                to: "/admin/uikit/list",
                name: "admin.list",
            },
            {
                label: "Tree",
                icon: "pi pi-fw pi-share-alt",
                to: "/admin/uikit/tree",
                name: "admin.tree",
            },
            {
                label: "Panel",
                icon: "pi pi-fw pi-tablet",
                to: "/admin/uikit/panel",
                name: "admin.panel",
            },
            {
                label: "Overlay",
                icon: "pi pi-fw pi-clone",
                to: "/admin/uikit/overlay",
                name: "admin.overlay",
            },
            {
                label: "Media",
                icon: "pi pi-fw pi-image",
                to: "/admin/uikit/media",
                name: "admin.media",
            },
            {
                label: "Menu",
                icon: "pi pi-fw pi-bars",
                to: "/admin/uikit/menu",
                name: "admin.menu",
                preventExact: true,
            },
            {
                label: "Message",
                icon: "pi pi-fw pi-comment",
                to: "/admin/uikit/message",
                name: "admin.message",
            },
            {
                label: "File",
                icon: "pi pi-fw pi-file",
                to: "/admin/uikit/file",
                name: "admin.file",
            },
            {
                label: "Chart",
                icon: "pi pi-fw pi-chart-bar",
                to: "/admin/uikit/charts",
                name: "admin.charts",
            },
            {
                label: "Misc",
                icon: "pi pi-fw pi-circle",
                to: "/admin/uikit/misc",
                name: "admin.misc",
            },
        ],
    },
    {
        label: "Prime Blocks",
        items: [
            {
                label: "Free Blocks",
                icon: "pi pi-fw pi-eye",
                to: "/admin/blocks",
                badge: "NEW",
                name: "admin.blocks",
            },
            {
                label: "All Blocks",
                icon: "pi pi-fw pi-globe",
                url: "https://www.primefaces.org/primeblocks-vue",
                target: "_blank",
            },
        ],
    },
    {
        label: "Utilities",
        items: [
            {
                label: "PrimeIcons",
                icon: "pi pi-fw pi-prime",
                url: "https://www.primefaces.org/diamond/icons.xhtml",
                target: "_blank",
            },
            {
                label: "PrimeFlex",
                icon: "pi pi-fw pi-desktop",
                url: "https://www.primefaces.org/primeflex/",
                target: "_blank",
            },
        ],
    },
    {
        label: "Pages",
        icon: "pi pi-fw pi-briefcase",
        to: "/pages",
        items: [
            {
                label: "Landing",
                icon: "pi pi-fw pi-globe",
                to: "/landing",
                name: "landing",
            },
            {
                label: "Auth",
                icon: "pi pi-fw pi-user",
                items: [
                    {
                        label: "Login",
                        icon: "pi pi-fw pi-sign-in",
                        to: "/admin/login",
                        name: "login",
                    },
                    {
                        label: "Error",
                        icon: "pi pi-fw pi-times-circle",
                        to: "/error",
                        name: "error",
                    },
                    {
                        label: "Access Denied",
                        icon: "pi pi-fw pi-lock",
                        to: "/access",
                        name: "accessDenied",
                    },
                ],
            },
            {
                label: "Crud",
                icon: "pi pi-fw pi-pencil",
                to: "/admin/pages/crud",
                name: "admin.crud",
            },
            {
                label: "Timeline",
                icon: "pi pi-fw pi-calendar",
                to: "/admin/pages/timeline",
                name: "admin.timeline",
            },
            {
                label: "Empty",
                icon: "pi pi-fw pi-circle-off",
                to: "/admin/pages/empty",
                name: "admin.empty",
            },
        ],
    },
    {
        label: "Hierarchy",
        items: [
            {
                label: "Submenu 1",
                icon: "pi pi-fw pi-bookmark",
                items: [
                    {
                        label: "Submenu 1.1",
                        icon: "pi pi-fw pi-bookmark",
                        items: [
                            {
                                label: "Submenu 1.1.1",
                                icon: "pi pi-fw pi-bookmark",
                            },
                            {
                                label: "Submenu 1.1.2",
                                icon: "pi pi-fw pi-bookmark",
                            },
                            {
                                label: "Submenu 1.1.3",
                                icon: "pi pi-fw pi-bookmark",
                            },
                        ],
                    },
                    {
                        label: "Submenu 1.2",
                        icon: "pi pi-fw pi-bookmark",
                        items: [
                            {
                                label: "Submenu 1.2.1",
                                icon: "pi pi-fw pi-bookmark",
                            },
                        ],
                    },
                ],
            },
            {
                label: "Submenu 2",
                icon: "pi pi-fw pi-bookmark",
                items: [
                    {
                        label: "Submenu 2.1",
                        icon: "pi pi-fw pi-bookmark",
                        items: [
                            {
                                label: "Submenu 2.1.1",
                                icon: "pi pi-fw pi-bookmark",
                            },
                            {
                                label: "Submenu 2.1.2",
                                icon: "pi pi-fw pi-bookmark",
                            },
                        ],
                    },
                    {
                        label: "Submenu 2.2",
                        icon: "pi pi-fw pi-bookmark",
                        items: [
                            {
                                label: "Submenu 2.2.1",
                                icon: "pi pi-fw pi-bookmark",
                            },
                        ],
                    },
                ],
            },
        ],
    },
    {
        label: "Get Started",
        items: [
            {
                label: "Documentation",
                icon: "pi pi-fw pi-question",
                to: "/admin/documentation",
                name: "admin.documentation",
            },
            {
                label: "View Source",
                icon: "pi pi-fw pi-search",
                url: "https://github.com/primefaces/sakai-vue",
                target: "_blank",
            },
            {
                label: "Nuxt Version",
                url: "https://github.com/primefaces/sakai-nuxt",
                icon: "pi pi-fw pi-star",
            },
        ],
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item
                v-if="!item.separator"
                :item="item"
                :index="i"
            ></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
        <li>
            <a
                href="https://www.primefaces.org/primeblocks-vue/#/"
                target="_blank"
            >
                <img
                    src="/layout/images/banner-primeblocks.png"
                    alt="Prime Blocks"
                    class="w-full mt-3"
                />
            </a>
        </li>
    </ul>
</template>

<style lang="scss" scoped></style>
