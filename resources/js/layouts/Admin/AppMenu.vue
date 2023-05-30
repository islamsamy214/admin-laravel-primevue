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
        label: "Collections",
        items: [
            {
                label: "Users",
                icon: "pi pi-users",
                to: "/admin/users",
                name: "admin.users",
            },
        ],
    },
    {
        label: "Pages",
        icon: "pi pi-fw pi-briefcase",
        to: "/pages",
        items: [
            // {
            //     label: "Landing",
            //     icon: "pi pi-fw pi-globe",
            //     to: "/landing",
            //     name: "landing",
            // },
            {
                label: "Auth",
                icon: "pi pi-fw pi-user",
                items: [
                    {
                        label: "Error",
                        icon: "pi pi-fw pi-times-circle",
                        to: "/error",
                        name: "error",
                    },
                    {
                        label: "Access Denied",
                        icon: "pi pi-fw pi-lock",
                        to: "/access-denied",
                        name: "access-denied",
                    },
                ],
            },
        ],
    },
    {
        label: "Prime Blocks",
        items: [
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
