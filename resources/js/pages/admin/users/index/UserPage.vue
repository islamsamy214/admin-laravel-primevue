<template>
    <Toast />
    <Loading v-if="loading" />
    <div class="grid" v-else>
        <div class="col-12">
            <div class="card">
                <Toolbar class="mb-4">
                    <template v-slot:start>
                        <div class="my-2">
                            <Button
                                label="New"
                                icon="pi pi-plus"
                                class="p-button-success mr-2"
                                @click="createNewUser"
                            />
                            <Button
                                label="Delete"
                                icon="pi pi-trash"
                                class="p-button-danger"
                                @click="confirmDeleteSelected"
                                :disabled="
                                    !selectedUsers || !selectedUsers.length
                                "
                            />
                        </div>
                    </template>

                    <template v-slot:end>
                        <Button
                            label="Export"
                            icon="pi pi-upload"
                            class="p-button-help"
                            @click="exportCSV($event)"
                        />
                    </template>
                </Toolbar>

                <user-list
                    ref="listUserComponent"
                    :currentUsers="currentUsers"
                    @selectUsers="selectUsers"
                    @editUser="editUser"
                    @deleteUser="fill"
                ></user-list>

                <edit-user ref="editUserComponent"></edit-user>

                <create-user
                    ref="createUserComponent"
                    @userCreated="fill"
                ></create-user>

                <Dialog
                    v-model:visible="deleteUsersDialog"
                    :style="{ width: '450px' }"
                    header="Confirm"
                    :modal="true"
                >
                    <div class="flex align-items-center justify-content-center">
                        <i
                            class="pi pi-exclamation-triangle mr-3"
                            style="font-size: 2rem"
                        />
                        <span v-if="user"
                            >Are you sure you want to delete the selected
                            users?</span
                        >
                    </div>
                    <template #footer>
                        <Button
                            label="No"
                            icon="pi pi-times"
                            class="p-button-text"
                            @click="deleteUsersDialog = false"
                        />
                        <Button
                            label="Yes"
                            icon="pi pi-check"
                            class="p-button-text"
                            @click="deleteSelectedUsers"
                        />
                    </template>
                </Dialog>
            </div>
        </div>
    </div>
</template>

<script>
import UserList from "./UserList.vue";
import EditUser from "../edit/EditUser.vue";
import CreateUser from "../create/CreateUser.vue";
import { useToast } from "primevue/usetoast";

export default {
    components: { UserList, EditUser, CreateUser },
    data() {
        return {
            currentUsers: [],
            deleteUsersDialog: false,
            selectedUsers: null,
            loading: false,
            isEmpty: false,
            errors: null,
        };
    }, //end of data

    methods: {
        createNewUser() {
            this.user = {};
            this.$refs.createUserComponent.openDialog();
        }, //end of openNew

        deleteSelectedUsers() {
            this.loading = true;
            axios
                .delete("/api/admin/users/delete/all", {
                    data: {
                        users: this.selectedUsers.map((val) => val.id),
                    },
                })
                .then((response) => {
                    // this.currentUsers = this.currentUsers.filter(
                    //     (val) => !this.selectedUsers.includes(val)
                    // );
                    this.fill();
                    this.selectedUsers = null;
                    this.toast.add({
                        severity: "success",
                        summary: "Successful",
                        detail: response.data.message,
                        life: 3000,
                    });
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
                    this.deleteUsersDialog = false;
                });
        }, //end of deleteSelectedUsers

        confirmDeleteSelected() {
            this.deleteUsersDialog = true;
        }, //end of confirmDeleteSelected

        exportCSV() {
            this.$refs.listUserComponent.exportCSV();
        }, //end of exportCSV

        fill() {
            this.loading = true;
            axios
                .get("/api/admin/users")
                .then((response) => {
                    this.currentUsers = response.data.users;
                })
                .catch((errors) => {
                    this.error = errors.response.data;
                })
                .then(() => {
                    this.loading = false;
                }); //end of axios request
        }, //end of fill function
        
        selectUsers(selectedUsers) {
            this.selectedUsers = selectedUsers;
        }, //end of selectUsers

        editUser(user) {
            this.$refs.editUserComponent.openDialog(user);
        }, //end of editUser
    }, //end of methods

    beforeMount() {
        this.toast = useToast();
    }, //end of beforeMount

    created() {
        this.fill();
    }, //end of created
};
</script>
