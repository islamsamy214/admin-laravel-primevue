<script>
import { useLayout } from "../../../layouts/Admin/composables/layout";
import AppConfig from "../../../layouts/Admin/AppConfig.vue";
import store from "../../../store";

export default {
    name: "AdminLogin",
    components: {
        AppConfig,
    },
    data() {
        return {
            loading: false,
            email: "",
            password: "",
            checked: false,
            errors: null,
        };
    }, //end of data

    computed: {
        logoUrl() {
            const { layoutConfig } = useLayout();
            return `../${layoutConfig.darkTheme.value ? "Logo" : "Logo"}.svg`;
        },
    }, //end of computed

    methods: {
        login() {
            this.loading = true;
            axios
                .post("/api/admin/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((response) => {
                    if (response.status == 200) {
                        localStorage.setItem("adminToken", response.data.token);
                        store.commit("adminAuth/login", response.data);
                        this.$router.push({ name: "admin.dashboard" });
                    }
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                })
                .then(() => {
                    this.loading = false;
                });
        }, // end of login

        forgetPassword() {
            //relax and try to remember it
            alert("Relax and try to remember it");
        }, //end of forgetPassword
    }, //end of methods

    async beforeRouteEnter(to, from, next) {
        // check if authnticated
        axios
            .get("/api/admin/user")
            .then((response) => {
                store.commit("adminAuth/login", response.data);
                next({ name: "admin.dashboard" });
            })
            .catch((error) => {
                // console.log(error);
            });
            next();
    }, //end of beforeRouteEnter
};
</script>

<template>
    <div
        class="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden"
    >
        <div class="flex flex-column align-items-center justify-content-center">
            <img
                :src="logoUrl"
                alt="Admin logo"
                class="mb-5 w-6rem flex-shrink-0"
            />
            <div
                style="
                    border-radius: 56px;
                    padding: 0.3rem;
                    background: linear-gradient(
                        180deg,
                        var(--primary-color) 10%,
                        rgba(33, 150, 243, 0) 30%
                    );
                "
            >
                <div
                    class="w-full surface-card py-8 px-5 sm:px-8"
                    style="border-radius: 53px"
                >
                    <div class="text-center mb-5">
                        <div class="text-900 text-3xl font-medium mb-3">
                            Welcome, Asa7bi!
                        </div>
                        <span class="text-600 font-medium"
                            >Sign in to continue</span
                        >
                    </div>
                    <div>
                        <label
                            for="email"
                            class="block text-900 text-xl font-medium mb-2"
                            >Email</label
                        >
                        <InputText
                            id="email"
                            type="text"
                            placeholder="Email address"
                            class="w-full md:w-30rem mb-5"
                            style="padding: 1rem"
                            v-model="email"
                        />

                        <label
                            for="password"
                            class="block text-900 font-medium text-xl mb-2"
                            >Password</label
                        >
                        <InputText
                            id="password"
                            v-model="password"
                            placeholder="Password"
                            type="password"
                            class="w-full mb-3"
                            inputClass="w-full"
                            inputStyle="padding:1rem"
                        />

                        <div
                            class="flex align-items-center justify-content-between mb-5 gap-5"
                        >
                            <div class="flex align-items-center">
                                <Checkbox
                                    v-model="checked"
                                    id="rememberme"
                                    binary
                                    class="mr-2"
                                ></Checkbox>
                                <label class="m-auto" for="rememberme"
                                    >Remember me</label
                                >
                            </div>
                            <Button
                                class="font-medium no-underline ml-2 text-right cursor-pointer"
                                label="Info"
                                severity="info"
                                text
                                style="color: var(--primary-color)"
                                @click.prevent="forgetPassword"
                                >Forgot password?</Button
                            >
                        </div>
                        <div v-if="errors" class="my-2">
                            <PageErrors :errors="errors" />
                        </div>
                        <Button
                            label="Sign In"
                            class="w-full p-3 text-xl"
                            @click.prevent="login"
                        ></Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <AppConfig simple />
</template>

<style scoped>
.pi-eye {
    transform: scale(1.6);
    margin-right: 1rem;
}

.pi-eye-slash {
    transform: scale(1.6);
    margin-right: 1rem;
}
</style>
