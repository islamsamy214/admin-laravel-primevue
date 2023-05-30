<script setup>
import { useLayout } from './composables/layout';
import { computed } from 'vue';

const { layoutConfig } = useLayout();

const logoUrl = computed(() => {
    return `../${layoutConfig.darkTheme.value ? 'Logo' : 'Logo'}.svg`;
});
</script>

<template>
    <div class="layout-footer">
        <img :src="logoUrl" alt="Logo" height="20" class="mr-2" />
        by
        <span class="font-medium ml-2">Islam Samy</span>
    </div>
</template>
<style lang="scss" scoped></style>
