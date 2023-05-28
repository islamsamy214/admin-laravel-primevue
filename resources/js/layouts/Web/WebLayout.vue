<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    async beforeRouteEnter(to, from, next) {
        //user auth
        try {
            const user = (await axios.get("/api/user")).data;
            store.commit("webAuth/login", user);
            next();
        } catch (error) {
            if (error.response.status == 401) {
                next({ name: "web.login" });
                // this.$router.push({ name: "admin-login" });
            }
        }
    },
};
</script>
