<template>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div v-else>
        <page-header>{{$t('users')}}</page-header>
        <div class="row">
            <user-search
                @submitSearch="submitSearch"
                :isEmpty="isEmpty"
                class="col-md-6 col-sm-12"
            ></user-search>
            <user-paginator
                :pages="pages"
                :currentPage="currentPage"
                :total="total"
                @fill="fill"
                class="col-md-6 col-sm-12"
            ></user-paginator>
        </div>
        <user-list
            :users="users"
            :pageLoading="pageLoading"
            @userDeleted="userDeleted"
        ></user-list>
    </div>
</template>

<script>
import UserList from "./UserList.vue";
import UserPaginator from "./UserPaginator.vue";
import UserSearch from "./UserSearch.vue";

export default {
    components: { UserList, UserPaginator, UserSearch },
    data() {
        return {
            users: [],
            isEmpty: false,
            pageLoading: true,
            error: null,
            //pagination
            currentPage: null,
            pages: [],
            total: 0,
        };
    },
    methods: {
        // start of filling the users
        fillUsers(response) {
            this.users = response.data.data;
        },
        //pagination
        fillPaginator(response) {
            this.pages = [];
            for (
                let resPage = 1;
                resPage <= response.data.last_page;
                resPage++
            ) {
                this.pages.push(resPage);
            }
            this.currentPage = response.data.current_page;
        },
        //end of filling the users

        //start of search
        submitSearch(search) {
            this.search = search;
            this.fill();
        },
        fillSearch(URL) {
            return URL + "&search=" + this.search;
        },
        //end of search

        getUrl(page) {
            typeof page === "undefined" ? (page = 1) : page;
            let URL = "/api/admin/users?page=" + page;

            //search section
            if (this.search) {
                URL = this.fillSearch(URL);
            }

            return URL;
        }, //end of stablish the URL

        fill(page) {
            this.pageLoading = true;

            let URL = this.getUrl(page);
            axios
                .get(URL)
                .then((response) => {
                    response.data.total == 0
                        ? (this.isEmpty = true)
                        : (this.isEmpty = false);
                    this.total = response.data.total;
                    this.fillUsers(response);
                    this.fillPaginator(response);
                })
                .then(() => {
                    this.pageLoading = false;
                })
                .catch((errors) => {
                    this.error = errors.response.data;
                }); //end of axios request
        }, //end of fill function

        //delete user
        userDeleted(id) {
            this.users = this.users.filter((user) => user.id != id);
            this.total--;
        },
    },
    created() {
        this.fill();
    },
};
</script>
