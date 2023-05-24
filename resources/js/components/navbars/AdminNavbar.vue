<template>
    <div>
        <nav
            class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
        >
            <router-link
                class="navbar-brand col-md-3 col-lg-2 mr-0 px-3"
                :to="{ name: 'admin.dashboard' }"
                >Blogs</router-link
            >
            <button
                class="navbar-toggler position-absolute d-md-none collapsed"
                type="button"
                data-toggle="collapse"
                data-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap dropdown">
                    <a
                        id="navbarDropdown"
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >{{ user.name }}</a
                    >
                    <div
                        class="dropdown-menu dropdown-menu-right position-absolute"
                        aria-labelledby="navbarDropdown"
                    >
                        <button
                            class="dropdown-item text-right"
                            @click="logout"
                        >
                            {{$t("logout")}}
                        </button>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import store from "../../store";
export default {
    computed: {
        ...mapGetters({
            user: "adminAuth/user",
            isLoggedIn: "adminAuth/isLoggedIn",
        }),
    }, //end of computed

    methods: {
        logout() {
            axios.post("/api/admin/logout", this.user).then((response) => {
                if (response.status == 200) {
                    store.commit("adminAuth/logout");
                    this.$router.push({ name: "admin.login" });
                }
            });
        }, //end of logout
    }, //end of methods
};
</script>

<style scoped>
/*
   * Navbar
   */
.navbar-brand {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    font-size: 1rem;
}

.navbar .navbar-toggler {
    top: 0.25rem;
    right: 1rem;
}

.navbar .form-control {
    padding: 0.75rem 1rem;
    border-width: 0;
    border-radius: 0;
}

.form-control-dark {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.1);
}

.form-control-dark:focus {
    border-color: transparent;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
}
</style>
