<template>
    <Dialog
        v-model:visible="userDialog"
        :style="{ width: '450px' }"
        :header="$t('editUser')"
        :modal="true"
        class="p-fluid"
    >
        <img
            :src="user.image_path"
            :alt="user.image"
            v-if="user.image"
            width="150"
            class="mt-0 mx-auto mb-5 block shadow-2"
        />

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

        <template #footer>
            <div
                :class="{
                    'flex flex-row-reverse float-left': $store.getters.isRtl,
                }"
            >
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
                    @click="updateUser"
                />
            </div>
        </template>
    </Dialog>
</template>

<script>
import { useToast } from "primevue/usetoast";

export default {
    data() {
        return {
            user: {},
            userDialog: false,
            submitted: false,
        };
    },
    methods: {
        updateUser() {
            this.submitted = true;

            if (this.user.name && this.user.name.trim() && this.user.email) {
                this.loading = true;
                const formData = new FormData();
                formData.append("name", this.user.name);
                formData.append("email", this.user.email);
                formData.append("role", this.user.role);
                formData.append("_method", "PUT");
                axios
                    .post("/api/admin/users/" + this.user.id, formData)
                    .then((response) => {
                        this.toast.add({
                            severity: "success",
                            summary: "Successful",
                            detail: response.data.message,
                            life: 3000,
                        });
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
        }, //end of updateUser

        editUser(editUser) {
            this.user = { ...editUser };
            this.userDialog = true;
        }, //end of editUser

        openDialog(user) {
            this.user = user;
            this.userDialog = true;
        }, //end of openDialog

        hideDialog() {
            this.user = {};
            this.userDialog = false;
            this.submitted = false;
        }, //end of hideDialog
    }, //end of methods

    beforeMount() {
        this.toast = useToast();
    }, //end of beforeMount
};
</script>
