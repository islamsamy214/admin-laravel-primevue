<template>
    <Loading v-if="loading" />
    <div v-else>
        <user-list :users="users"></user-list>
    </div>
</template>

<script>
import UserList from "./UserList.vue";

export default {
    components: { UserList },
    data() {
        return {
            users: [],
            loading: false,
            isEmpty: false,
            errors: null,
        };
    },
    methods: {
        fill() {
            this.loading = true;
            axios
                .get("/api/admin/users")
                .then((response) => {
                    this.users = response.data.users;
                })
                .catch((errors) => {
                    this.error = errors.response.data;
                })
                .then(() => {
                    this.loading = false;
                }); //end of axios request
        }, //end of fill function
    },
    created() {
        this.fill();
    },
};
</script>
