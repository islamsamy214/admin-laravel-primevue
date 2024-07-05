<script setup>
import { useLayout } from "./composables/layout";
import { computed } from "vue";
import store from "../../store";

const { layoutConfig } = useLayout();

const changeLanguage = (lang) => {
    store.commit("setLocale", { locale: lang });
};

const logoUrl = computed(() => {
    return `../${layoutConfig.darkTheme.value ? "Logo" : "Logo"}.svg`;
});
</script>

<template>
    <div
        class="layout-footer"
        :class="$store.getters['isRtl'] ? 'flex flex-row-reverse' : ''"
    >
        <img :src="logoUrl" alt="Logo" height="20" class="mx-2" />
        {{ $t("by") }}
        <span class="font-medium mx-2"
            ><a
                href="https://islamdev.me"
                class="transition ease-in-out no-underline"
                >Islam Samy</a
            >
        </span>
        <button
            class="btn btn-link btn-sm p-0 ml-1"
            @click="changeLanguage('ar')"
        >
            العربية
        </button>
        <button
            class="btn btn-link btn-sm p-0 ml-1"
            @click="changeLanguage('en')"
        >
            English
        </button>
    </div>
</template>
<style lang="scss" scoped></style>
