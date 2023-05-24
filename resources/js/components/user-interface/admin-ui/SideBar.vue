<template>
    <div>
        <div
            class="sidebar-sticky pt-3 d-flex flex-column justify-content-between"
        >
            <ul class="nav flex-column">
                <li class="nav-item mb-5">
                    <router-link
                        class="nav-link"
                        :class="{
                            active:
                                this.$route.fullPath.split('/')[2] ==
                                'dashboard',
                        }"
                        :to="{ name: 'admin.dashboard' }"
                    >
                        <img
                            src="/Logo.svg"
                            class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                            alt=""
                        />
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        class="nav-link"
                        :to="{ name: 'admin.dashboard' }"
                        :class="{
                            active:
                                this.$route.fullPath.split('/')[2] ==
                                'dashboard',
                        }"
                    >
                        <h5 class="d-flex align-items-center">
                            <Icon icon="tabler:layout-dashboard" />
                            <span>{{ $t("dashboard") }}</span>
                        </h5>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        class="nav-link"
                        :to="{ name: 'admin.settings' }"
                        :class="{
                            active:
                                this.$route.fullPath.split('/')[2] ==
                                'settings',
                        }"
                    >
                        <h5 class="d-flex align-items-center">
                            <Icon icon="bi:gear" />
                            <span>{{ $t("settings") }}</span>
                        </h5>
                    </router-link>
                </li>
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"
                >
                    <span>{{$t('collections')}}</span>
                </h6>

                <li class="nav-item">
                    <router-link
                        class="nav-link"
                        :to="{ name: 'admin.users' }"
                        :class="{
                            active:
                                this.$route.fullPath.split('/')[2] == 'users',
                        }"
                    >
                        <h5 class="d-flex align-items-center">
                            <Icon icon="solar:users-group-rounded-broken" />
                            <span>{{ $t("users") }}</span>
                        </h5>
                    </router-link>
                </li>
            </ul>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <div class="nav-link">
                        <h6 class="d-flex align-items-center">
                            <Icon icon="ph:user-bold" />
                            <span>{{ user.name }}</span>
                        </h6>
                    </div>
                </li>

                <li class="nav-item logout">
                    <div class="nav-link" @click="logout">
                        <h5 class="d-flex align-items-center text-danger">
                            <Icon icon="solar:logout-outline" />
                            <span>{{$t("logout")}}</span>
                        </h5>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import store from "../../../store";
import { mapGetters } from "vuex";

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
    },
};
</script>

<style scoped>
/*
 * Sidebar
 */
.logout {
    cursor: pointer;
}

.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    /* Behind the navbar */
    padding: 48px 0 0;
    /* Height of navbar */
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
    }
}

.sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: 0.5rem;
    overflow-x: hidden;
    overflow-y: auto;
    /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
    .sidebar-sticky {
        position: -webkit-sticky;
        position: sticky;
    }
}

.sidebar .nav-link {
    font-weight: 500;
    color: #333;
}

.sidebar .nav-link.active {
    color: #007bff;
}

.sidebar-heading {
    font-size: 0.75rem;
    text-transform: uppercase;
}
svg {
    margin: 0 10px;
}
h5 {
    opacity: 0.8;
}
</style>
