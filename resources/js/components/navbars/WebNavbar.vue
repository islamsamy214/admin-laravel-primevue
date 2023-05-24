<template>
  <div>
    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm mb-2">
      <div class="container">
        <router-link class="navbar-brand" to="/"> Blogs </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"></ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Navigation links -->
            <div div class="navbar-nav ml-auto">
              <li class="nav-item">
                <router-link :to="{ name: 'home' }" class="nav-link"
                  >Home</router-link
                >
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'posts' }" class="nav-link"
                  >Blogs</router-link
                >
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'about' }" class="nav-link"
                  >About</router-link
                >
              </li>
            </div>

            <!-- Authentication Links -->
            <div class="navbar-nav ml-auto" v-if="isLoggedIn">
              <li class="nav-item dropdown">
                <a
                  id="navbarDropdown"
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  {{ user.name }}
                </a>

                <div
                  class="dropdown-menu dropdown-menu-right"
                  aria-labelledby="navbarDropdown"
                >
                  <button class="dropdown-item" @click="logout">{{$t("logout")}}</button>
                </div>
              </li>
            </div>

            <div class="navbar-nav ml-auto" v-else>
              <li class="nav-item">
                <router-link :to="{ name: 'login' }" class="nav-link"
                  >Login</router-link
                >
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'register' }" class="nav-link"
                  >Register</router-link
                >
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters({ user: "webAuth/user", isLoggedIn: "webAuth/isLoggedIn" }),
  }, //end of computed

  methods: {
    logout() {
      axios.post("/logout", this.user).then((response) => {
        this.$store.commit("logout");
        if (response.status == 204) {
          this.$router.push({ name: "home" }).then(location.reload());
        }
      });
    }, //end of logout
  }, //end of methods

};
</script>