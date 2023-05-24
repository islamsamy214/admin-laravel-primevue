<template>
    <div>
        <div class="row justify-content-left m-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $t("edit") }} {{$t('user')}}</div>
                    <div class="card-body">
                        <form
                            @submit.prevent="fillForm"
                            enctype="multipart/form-data"
                        >
                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("name") }}</label
                                >
                                <div class="col-md-9">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        required
                                        autocomplete="name"
                                        autofocus
                                        v-model="name"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="email"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("email") }}</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        required
                                        autocomplete="email"
                                        v-model="email"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("role") }}</label
                                >
                                <div class="col-md-9">
                                    <select class="form-control" v-model="role">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("password") }}</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        autocomplete="new-password"
                                        v-model="password"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="password-confirm"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("passwordConfirmation") }}</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        autocomplete="new-password"
                                        v-model="password_confirmation"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="image"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("image") }}</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="image"
                                        type="file"
                                        class="form-control"
                                        name="image"
                                        @change="uploadImage"
                                    />
                                </div>
                            </div>

                            <!-- start of error section -->
                            <div
                                class="card w-75 mx-auto mb-3 alert alert-danger"
                                v-if="errors"
                            >
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item"
                                        v-if="errors.name"
                                    >
                                        <div
                                            v-for="error in errors.name"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item"
                                        v-if="errors.email"
                                    >
                                        <div
                                            v-for="error in errors.email"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item"
                                        v-if="errors.role"
                                    >
                                        <div
                                            v-for="error in errors.role"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>

                                    <li
                                        class="list-group-item"
                                        v-if="errors.password"
                                    >
                                        <div
                                            v-for="error in errors.password"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item"
                                        v-if="errors.image"
                                    >
                                        <div
                                            v-for="error in errors.image"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- end of error section -->

                            <div class="form-group row mb-0 text-right">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="isLoading || sameValue"
                                    >
                                        {{ $t("submit") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["isLoading", "errors", "oldName", "oldEmail", "oldRole"],

    emits: ["submitUser"],

    data() {
        return {
            name: this.oldName,
            email: this.oldEmail,
            role: this.oldRole,
            password: null,
            password_confirmation: null,
            image: null,
            sameValue: true,
        };
    }, //end of data

    watch: {
        name(newName) {
            if (newName == this.oldName) {
                this.sameValue = true;
            } else {
                this.sameValue = false;
            }
        }, //end of name

        email(newEmail) {
            if (newEmail == this.oldEmail) {
                this.sameValue = true;
            } else {
                this.sameValue = false;
            }
        }, //end of email

        role(newRole) {
            if (newRole == this.oldRole) {
                this.sameValue = true;
            } else {
                this.sameValue = false;
            }
        }, //end of role

        password(newPassword) {
            if (newPassword == null) {
                this.sameValue = true;
            } else {
                this.sameValue = false;
            }
        }, //end of password

        image(newImage) {
            if (newImage == null) {
                this.sameValue = true;
            } else {
                this.sameValue = false;
            }
        }, //end of image
    }, //end of watch

    methods: {
        uploadImage(event) {
            this.image = event.currentTarget.files[0];
        }, //end of image upload

        fillForm() {
            let formData = new FormData();
            formData.append("name", this.name);
            formData.append("email", this.email);
            formData.append("role", this.role);
            if (this.password) {
                formData.append("password", this.password);
            }
            formData.append(
                "password_confirmation",
                this.password_confirmation
            );
            formData.append("_method", "PUT");
            if (this.image) {
                formData.append("image", this.image);
            }

            this.$emit("submitUser", formData);
        }, //end of filling form
    }, //end of methods
};
</script>
