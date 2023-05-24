<template>
    <div>
        <nav class="navbar navbar-light bg-light d-flex justify-content-center">
            <span class="navbar-text">
                &copy; {{ new Date().getFullYear() }}
                <a href="http://islamsamy214.github.io/" target="_blank"
                    >Islam Samy. {{$t('allRightsReserved')}}</a
                >
                <button
                    class="btn btn-link"
                    @click.prevent="changeLang(lang)"
                    v-for="lang in langs"
                    :key="lang.code"
                >
                    {{ lang.name }}
                </button>
            </span>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            langs: [
                { name: "English", code: "en" },
                { name: "العربية", code: "ar" },
            ],
        };
    }, // end of data

    methods: {
        changeLang(lang) {
            this.$i18n.locale = lang.code;
            this.$store.commit("setLocale", { locale: lang.code });
        },
    }, // end of methods
};
</script>