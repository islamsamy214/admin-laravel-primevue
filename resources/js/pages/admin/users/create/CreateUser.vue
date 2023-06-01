<template>
    <Loading v-if="loading" />
    <Dialog
        v-model:visible="newUserDialog"
        :style="{ width: '450px' }"
        :header="$t('newUser')"
        :modal="true"
        class="p-fluid"
    >
        <div class="field text-center">
            <div class="p-inputgroup">
                <div class="custom-file">
                    <Button
                        icon="pi pi-upload"
                        class="p-button-success w-full"
                        :label="$t('image')"
                        @click="$refs.image.click()"
                    />
                    <input
                        type="file"
                        ref="image"
                        accept="image/*"
                        @change="uploadImage"
                        hidden
                    />
                </div>
            </div>
        </div>
        <div class="field">
            <label
                for="name"
                :class="[{ 'float-right': $store.getters.isRtl }]"
                >{{ $t("name") }}</label
            >
            <InputText
                id="name"
                v-model.trim="user.name"
                required="true"
                autofocus
                type="text"
                :class="[
                    { 'p-invalid': submitted && !user.name },
                    { 'text-right': $store.getters.isRtl },
                ]"
            />
            <small class="p-invalid" v-if="submitted && !user.name">{{
                $t("nameIsRequired")
            }}</small>
        </div>
        <div class="field">
            <label
                for="email"
                :class="[{ 'float-right': $store.getters.isRtl }]"
                >{{ $t("email") }}</label
            >
            <InputText
                id="email"
                v-model.trim="user.email"
                required="true"
                type="email"
                :class="[
                    { 'p-invalid': submitted && !user.email },
                    { 'text-right': $store.getters.isRtl },
                ]"
            />
            <small class="p-invalid" v-if="submitted && !user.email">{{
                $t("emailIsRequired")
            }}</small>
        </div>
        <div class="field">
            <label
                class="mb-3"
                :class="[{ 'float-right': $store.getters.isRtl }]"
                >{{ $t("role") }}</label
            >
            <div class="formgrid grid">
                <div class="field-radiobutton col-6">
                    <RadioButton
                        id="role1"
                        name="role"
                        value="admin"
                        v-model="user.role"
                    />
                    <label for="role1">{{ $t("admin") }}</label>
                </div>
                <div class="field-radiobutton col-6">
                    <RadioButton
                        id="role2"
                        name="role"
                        value="user"
                        v-model="user.role"
                    />
                    <label for="role2">{{ $t("user") }}</label>
                </div>
            </div>
        </div>
        <div class="field">
            <label
                for="password"
                :class="[{ 'float-right': $store.getters.isRtl }]"
                >{{ $t("password") }}</label
            >
            <InputText
                id="password"
                v-model.trim="user.password"
                required="true"
                type="password"
                :class="[
                    {
                        'p-invalid':
                            (submitted && !user.password) ||
                            (submitted &&
                                user.password_confirmation !== user.password),
                    },
                    { 'text-right': $store.getters.isRtl },
                ]"
            />
            <small class="p-invalid" v-if="submitted && !user.password">{{
                $t("passwordIsRequired")
            }}</small>
        </div>
        <div class="field">
            <label
                for="password_confirmation"
                :class="[{ 'float-right': $store.getters.isRtl }]"
                >{{ $t("passwordConfirmation") }}</label
            >
            <InputText
                id="password_confirmation"
                v-model.trim="user.password_confirmation"
                required="true"
                type="password"
                :class="[
                    {
                        'p-invalid':
                            (submitted && !user.password) ||
                            (submitted &&
                                user.password_confirmation !== user.password),
                    },
                    { 'text-right': $store.getters.isRtl },
                ]"
            />
            <small
                class="p-invalid"
                v-if="submitted && !user.password_confirmation"
                >{{ $t("passwordConfirmationIsRequired") }}</small
            >
            <small
                class="p-invalid"
                v-if="submitted && user.password_confirmation !== user.password"
                >{{ $t("passwordConfirmationMustMatchPassword") }}</small
            >
        </div>

        <template #footer>
            <div :class="{ 'flex flex-row-reverse float-left': $store.getters.isRtl }">
                <Button
                    :label="$t('cancel')"
                    icon="pi pi-times"
                    class="p-button-text"
                    @click="hideDialog"
                />
                <Button
                    :label="$t('submit')"
                    icon="pi pi-check"
                    class="p-button-text"
                    @click="createUser"
                />
            </div>
        </template>
    </Dialog>
</template>
<script>
import { useToast } from "primevue/usetoast";

export default {
    emits: ["userCreated"],

    data() {
        return {
            newUserDialog: false,
            user: {
                name: "",
                email: "",
                role: "",
                password: "",
                password_confirmation: "",
                image: "",
            },
            submitted: false,
            loading: false,
        };
    }, //end of data

    beforeMount() {
        this.toast = useToast();
    },

    methods: {
        uploadImage(event) {
            if (!event.target.files[0]) return;
            this.user.image = event.target.files[0];
        }, //end of uploadImage
        createUser() {
            this.submitted = true;
            if (
                this.user.name &&
                this.user.name.trim() &&
                this.user.email &&
                this.user.password &&
                this.user.password_confirmation
            ) {
                this.loading = true;
                const formData = new FormData();
                for (let key in this.user) {
                    formData.append(key, this.user[key]);
                }
                axios
                    .post("/api/admin/users", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((response) => {
                        this.toast.add({
                            severity: "success",
                            summary: "Successful",
                            detail: response.data.message,
                            life: 3000,
                        });
                        this.$emit("userCreated");
                        this.hideDialog();
                    })
                    .catch((errors) => {
                        if (errors.response) {
                            this.toast.add({
                                severity: "error",
                                summary: "Error",
                                detail: errors.response.data.message,
                                life: 15000,
                            });
                        }
                    })
                    .then(() => {
                        this.loading = false;
                    });
            }
        }, //end of createUser

        openDialog() {
            this.newUserDialog = true;
        }, //end of openDialog

        hideDialog() {
            this.user = {};
            this.submitted = false;
            this.newUserDialog = false;
        }, //end of hideDialog
    },
};
</script>
