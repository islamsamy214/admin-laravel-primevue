<template>
    <Loading v-if="loading" />
    <Dialog
        v-model:visible="newUserDialog"
        :style="{ width: '450px' }"
        header="User Details"
        :modal="true"
        class="p-fluid"
    >
        <div class="field text-center">
            <div class="p-inputgroup">
                <div class="custom-file">
                    <Button
                        icon="pi pi-upload"
                        class="p-button-success w-full"
                        label="Image"
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
            <label for="name">Name</label>
            <InputText
                id="name"
                v-model.trim="user.name"
                required="true"
                autofocus
                type="text"
                :class="{ 'p-invalid': submitted && !user.name }"
            />
            <small class="p-invalid" v-if="submitted && !user.name"
                >Name is required.</small
            >
        </div>
        <div class="field">
            <label for="email">Email</label>
            <InputText
                id="email"
                v-model.trim="user.email"
                required="true"
                type="email"
                :class="{ 'p-invalid': submitted && !user.email }"
            />
            <small class="p-invalid" v-if="submitted && !user.email"
                >Email is required.</small
            >
        </div>
        <div class="field">
            <label class="mb-3">Role</label>
            <div class="formgrid grid">
                <div class="field-radiobutton col-6">
                    <RadioButton
                        id="role1"
                        name="role"
                        value="admin"
                        v-model="user.role"
                    />
                    <label for="role1">Admin</label>
                </div>
                <div class="field-radiobutton col-6">
                    <RadioButton
                        id="role2"
                        name="role"
                        value="user"
                        v-model="user.role"
                    />
                    <label for="role2">User</label>
                </div>
            </div>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <InputText
                id="password"
                v-model.trim="user.password"
                required="true"
                type="password"
                :class="{
                    'p-invalid':
                        (submitted && !user.password) ||
                        (submitted &&
                            user.password_confirmation !== user.password),
                }"
            />
            <small class="p-invalid" v-if="submitted && !user.password"
                >Password is required.</small
            >
        </div>
        <div class="field">
            <label for="password_confirmation">Password Confirmation</label>
            <InputText
                id="password_confirmation"
                v-model.trim="user.password_confirmation"
                required="true"
                type="password"
                :class="{
                    'p-invalid':
                        (submitted && !user.password) ||
                        (submitted &&
                            user.password_confirmation !== user.password),
                }"
            />
            <small
                class="p-invalid"
                v-if="submitted && !user.password_confirmation"
                >Password Confirmation is required.</small
            >
            <small
                class="p-invalid"
                v-if="submitted && user.password_confirmation !== user.password"
                >Password Confirmation must match Password.</small
            >
        </div>

        <template #footer>
            <Button
                label="Cancel"
                icon="pi pi-times"
                class="p-button-text"
                @click="hideDialog"
            />
            <Button
                label="Save"
                icon="pi pi-check"
                class="p-button-text"
                @click="createUser"
            />
        </template>
    </Dialog>
</template>
<script>

export default {
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
                        this.users.unshift(this.user);
                        // this.toast.add({
                        //     severity: "success",
                        //     summary: "Successful",
                        //     detail: response.data.message,
                        //     life: 3000,
                        // });
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
            console.log("hideDialog");
            this.user = {};
            this.submitted = false;
            this.newUserDialog = false;
        }, //end of hideDialog
    },
};
</script>
