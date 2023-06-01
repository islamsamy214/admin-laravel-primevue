<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { useLayout } from "./composables/layout";
import { useRouter } from "vue-router";

const { layoutConfig, onMenuToggle } = useLayout();

const outsideClickListener = ref(null);
const topbarMenuActive = ref(false);
const profileMenu = ref(null);
const router = useRouter();

onMounted(() => {
    bindOutsideClickListener();
});

onBeforeUnmount(() => {
    unbindOutsideClickListener();
});

const logoUrl = computed(() => {
    return `../${layoutConfig.darkTheme.value ? "Logo" : "Logo"}.svg`;
});

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};
const toggleProfileMenu = (event) => {
    profileMenu.value.toggle(event);
};
const logout = () => {
    
};
const onSettingsClick = () => {
    topbarMenuActive.value = false;
    // router.push("/documentation");
};
const topbarMenuClasses = computed(() => {
    return {
        "layout-topbar-menu-mobile-active": topbarMenuActive.value,
    };
});

const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                topbarMenuActive.value = false;
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
    if (!topbarMenuActive.value) return;

    const sidebarEl = document.querySelector(".layout-topbar-menu");
    const topbarEl = document.querySelector(".layout-topbar-menu-button");

    return !(
        sidebarEl.isSameNode(event.target) ||
        sidebarEl.contains(event.target) ||
        topbarEl.isSameNode(event.target) ||
        topbarEl.contains(event.target)
    );
};
</script>

<script>
import store from "../../store";
export default {
    computed: {
        isRtl() {
            return {
                "flex flex-row-reverse": store.getters["isRtl"],
            };
        },
    },
};
</script>

<template>
    <div class="layout-topbar" :class="isRtl">
        <router-link
            :to="{ name: 'admin.dashboard' }"
            class="layout-topbar-logo"
            :class="isRtl"
        >
            <img :src="logoUrl" alt="logo" />
            <span class="mx-5">{{ $t("admin") }}</span>
        </router-link>

        <button
            class="p-link layout-menu-button layout-topbar-button"
            @click="onMenuToggle()"
        >
            <i class="pi pi-bars"></i>
        </button>

        <button
            class="p-link layout-topbar-menu-button layout-topbar-button"
            @click="onTopBarMenuButton()"
        >
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div
            class="layout-topbar-menu"
            :class="topbarMenuClasses"
            :style="
                $store.getters['isRtl']
                    ? 'justify-content: start; margin:0; width:100%'
                    : ''
            "
        >
            <!-- <button @click="onTopBarMenuButton()" class="p-link layout-topbar-button">
                <i class="pi pi-calendar"></i>
                <span>Calendar</span>
            </button> -->
            <Button
                type="button"
                @click="toggleProfileMenu($event)"
                class="p-link layout-topbar-button"
                v-tooltip.bottom="$store.getters['adminAuth/user'].name"
            >
                <i class="pi pi-user"></i>
                <span>Profile</span>
            </Button>
            <OverlayPanel
                ref="profileMenu"
                appendTo="body"
                :showCloseIcon="true"
            >
                <Button
                    :label="$t('logout')"
                    class="p-button-danger p-button-text p-0"
                    @click="logout()"
                />
            </OverlayPanel>
            <router-link
                :to="{ name: 'admin.settings' }"
                @click="onSettingsClick()"
                class="p-link layout-topbar-button text-decoration-none"
            >
                <i class="pi pi-cog"></i>
                <span>Settings</span>
            </router-link>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
