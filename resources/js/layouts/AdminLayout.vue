<template>
    <div>
        <!-- <admin-navbar></admin-navbar> -->
        <div class="container-fluid">
            <div class="row" id="main">
                <nav
                    id="sidebarMenu"
                    class="col-md-3 col-lg-2 d-md-block sidebar collapse"
                >
                    <side-bar></side-bar>
                </nav>
                <main
                    role="main"
                    class="col-md-9 ml-sm-auto col-lg-10 px-md-4 d-flex flex-column justify-content-between"
                >
                    <router-view></router-view>
                    <admin-footer></admin-footer>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
// import AdminNavbar from "./../navbars/AdminNavbar.vue";
import AdminFooter from "../components/user-interface/admin-ui/AdminFooter.vue";
import SideBar from "../components/user-interface/admin-ui/SideBar.vue";
import store from "../store";

export default {
    components: {
        // AdminNavbar,
        AdminFooter,
        SideBar,
    }, //end of components

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
};
</script>

<style scoped>
#sidebarMenu {
    background-color: #f2f2f2;
}
#main {
    min-height: 100vh;
}
</style>
