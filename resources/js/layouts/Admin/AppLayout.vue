<template>
    <div class="layout-wrapper" :class="containerClass">
        <app-topbar></app-topbar>
        <div class="layout-sidebar">
            <app-sidebar></app-sidebar>
        </div>
        <div class="layout-main-container">
            <div class="layout-main">
                <router-view></router-view>
            </div>
            <app-footer></app-footer>
        </div>
        <app-config></app-config>
        <div class="layout-mask"></div>
    </div>
</template>

<script>
import { computed, watch, ref } from "vue";
import AppTopbar from "./AppTopbar.vue";
import AppFooter from "./AppFooter.vue";
import AppSidebar from "./AppSidebar.vue";
import AppConfig from "./AppConfig.vue";
import { useLayout } from "./composables/layout";
import store from "../../store";

export default {
    components: {
        AppTopbar,
        AppFooter,
        AppSidebar,
        AppConfig,
    },
    async beforeRouteEnter(to, from, next) {
        // check if authnticated
        try {
            const user = (await axios.get("/api/admin/user")).data;
            store.commit("adminAuth/login", user);
            next();
        } catch (error) {
            if (error.response.status == 401) {
                next({ name: "admin.login" });
                // this.$router.push({ name: "admin-login" });
            }
        }
    },
    setup() {
        const { layoutConfig, layoutState, isSidebarActive } = useLayout();

        const outsideClickListener = ref(null);

        watch(isSidebarActive, (newVal) => {
            if (newVal) {
                bindOutsideClickListener();
            } else {
                unbindOutsideClickListener();
            }
        });

        const containerClass = computed(() => {
            if (store.getters["isRtl"]) {
                return {
                    "layout-theme-light":
                        layoutConfig.darkTheme.value === "light",
                    "layout-theme-dark":
                        layoutConfig.darkTheme.value === "dark",
                    "layout-overlay": layoutConfig.menuMode.value === "overlay",
                    "layout-static": layoutConfig.menuMode.value === "static",
                    "layout-static-inactive layout-static-inactive-rtl":
                        layoutState.staticMenuDesktopInactive.value &&
                        layoutConfig.menuMode.value === "static",
                    "layout-overlay-active":
                        layoutState.overlayMenuActive.value,
                    "layout-mobile-active layout-mobile-active-rtl":
                        layoutState.staticMenuMobileActive.value,
                    "p-input-filled":
                        layoutConfig.inputStyle.value === "filled",
                    "p-ripple-disabled": !layoutConfig.ripple.value,
                    "layout-sidebar-right": true,
                };
            }
            return {
                "layout-theme-light": layoutConfig.darkTheme.value === "light",
                "layout-theme-dark": layoutConfig.darkTheme.value === "dark",
                "layout-overlay": layoutConfig.menuMode.value === "overlay",
                "layout-static": layoutConfig.menuMode.value === "static",
                "layout-static-inactive":
                    layoutState.staticMenuDesktopInactive.value &&
                    layoutConfig.menuMode.value === "static",
                "layout-overlay-active": layoutState.overlayMenuActive.value,
                "layout-mobile-active":
                    layoutState.staticMenuMobileActive.value,
                "p-input-filled": layoutConfig.inputStyle.value === "filled",
                "p-ripple-disabled": !layoutConfig.ripple.value,
            };
        });

        const bindOutsideClickListener = () => {
            if (!outsideClickListener.value) {
                outsideClickListener.value = (event) => {
                    if (isOutsideClicked(event)) {
                        layoutState.overlayMenuActive.value = false;
                        layoutState.staticMenuMobileActive.value = false;
                        layoutState.menuHoverActive.value = false;
                    }
                };
                document.addEventListener("click", outsideClickListener.value);
            }
        };

        const unbindOutsideClickListener = () => {
            if (outsideClickListener.value) {
                document.removeEventListener("click", outsideClickListener);
                outsideClickListener.value = null;
            }
        };

        const isOutsideClicked = (event) => {
            const sidebarEl = document.querySelector(".layout-sidebar");
            const topbarEl = document.querySelector(".layout-menu-button");

            return !(
                sidebarEl.isSameNode(event.target) ||
                sidebarEl.contains(event.target) ||
                topbarEl.isSameNode(event.target) ||
                topbarEl.contains(event.target)
            );
        };

        return {
            containerClass,
        };
    },
};
</script>

<style lang="scss">
.p-editor-toolbar {
    display: none;
}
.ql-toolbar {
    position: relative;
    border-top-left-radius: 0.375rem; /* 6px */
    border-top-right-radius: 0.375rem; /* 6px */
    opacity: 0.7;
    z-index: 1;
}
.layout-sidebar-right {
    .layout-sidebar {
        right: 2rem;
        left: auto;
    }
    .layout-main-container {
        margin-left: auto !important;
        margin-right: 23.8rem !important;
        padding-left: 2rem;
    }
    @media screen and (max-width: 991px) {
        .layout-main-container {
            margin-right: 0 !important;
        }
    }
}
.layout-static-inactive-rtl {
    .layout-sidebar {
        transform: translateX(100%) !important;
        right: 0 !important;
        left: auto !important;
    }
    .layout-main-container {
        margin-left: auto !important;
        margin-right: 0 !important;
    }
}
.layout-mobile-active-rtl {
    .layout-sidebar {
        transform: translateX(0) !important;
        right: 0 !important;
        left: auto !important;
        border-top-left-radius: 6px !important;
        border-bottom-left-radius: 6px !important;
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    .layout-main-container {
        margin-left: auto !important;
        margin-right: 0 !important;
    }
}
</style>
