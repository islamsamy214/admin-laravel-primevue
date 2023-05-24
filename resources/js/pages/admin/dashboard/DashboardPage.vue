<template>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div v-else>
        <page-header>{{ $t("dashboard") }}</page-header>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pageLoading: true,
        };
    }, //end of data

    mounted() {
        this.pageLoading = false;
    }, //end of created
};
</script>
