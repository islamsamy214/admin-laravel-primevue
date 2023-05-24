<template>
  <div>
    <web-navbar></web-navbar>
    <div class="clearfix" style="height: 3.5rem"></div>
    <div class="container-fluied">
      <router-view></router-view>
    </div>
    <web-footer></web-footer>
  </div>
</template>

<script>
import WebFooter from "../components/user-interface/web-ui/WebFooter.vue";
import WebNavbar from "../components/navbars/WebNavbar.vue";
export default {
  components: {
    WebNavbar,
    WebFooter,
  }, //end of components

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