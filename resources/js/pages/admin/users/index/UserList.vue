<template>
    <Loading v-if="loading" />
    <DataTable
        ref="dt"
        :value="users"
        v-model:selection="selectedUsers"
        dataKey="id"
        :paginator="true"
        :rows="10"
        :filters="filters"
        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
        :rowsPerPageOptions="[5, 10, 25]"
        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} users"
        responsiveLayout="scroll"
    >
        <template #header>
            <div
                class="flex flex-column md:flex-row md:justify-content-between md:align-items-center"
            >
                <h5 class="m-0">Manage Users</h5>
                <span class="block mt-2 md:mt-0 p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Search..."
                    />
                </span>
            </div>
        </template>

        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>

        <Column
            field="name"
            header="Name"
            :sortable="true"
            headerStyle="width:14%; min-width:10rem;"
        >
            <template #body="slotProps">
                <span class="p-column-title">Name</span>
                {{ slotProps.data.name }}
            </template>
        </Column>

        <Column header="Image" headerStyle="width:14%; min-width:10rem;">
            <template #body="slotProps">
                <span class="p-column-title">Image</span>
                <img
                    :src="slotProps.data.image_path"
                    :alt="slotProps.data.image"
                    class="shadow-2"
                    width="100"
                />
            </template>
        </Column>

        <Column
            field="email"
            header="Email"
            :sortable="true"
            headerStyle="width:14%; min-width:10rem;"
        >
            <template #body="slotProps">
                <span class="p-column-title">Email</span>
                {{ slotProps.data.email }}
            </template>
        </Column>

        <Column
            field="role"
            header="Role"
            :sortable="true"
            headerStyle="width:14%; min-width:10rem;"
        >
            <template #body="slotProps">
                <span class="p-column-title">Role</span>
                {{ slotProps.data.role }}
            </template>
        </Column>

        <Column
            field="action"
            headerStyle="min-width:10rem;"
            class="text-center"
        >
            <template #body="slotProps">
                <Button
                    icon="pi pi-pencil"
                    class="p-button-rounded p-button-success mr-2"
                    @click="editUser(slotProps.data)"
                />
                <Button
                    icon="pi pi-trash"
                    class="p-button-rounded p-button-warning mt-2"
                    @click="confirmDeleteUser(slotProps.data)"
                />
            </template>
        </Column>
    </DataTable>
    <Dialog
        v-model:visible="deleteUserDialog"
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
                >Are you sure you want to delete <b>{{ user.name }}</b
                >?</span
            >
        </div>
        <template #footer>
            <Button
                label="No"
                icon="pi pi-times"
                class="p-button-text"
                @click="deleteUserDialog = false"
            />
            <Button
                label="Yes"
                icon="pi pi-check"
                class="p-button-text"
                @click="deleteUser"
            />
        </template>
    </Dialog>
</template>

<script>
import { FilterMatchMode } from "primevue/api";
import { useToast } from "primevue/usetoast";

export default {
    props: {
        currentUsers: {
            type: Array,
            required: true,
        },
    }, //end of props

    emits: ["selectUsers", "deleteUser", "editUser"],

    data() {
        return {
            toast: null,
            loading: false,
            userDialog: false,
            deleteUserDialog: false,
            user: {},
            users: this.currentUsers,
            selectedUsers: null,
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            },
        };
    }, //end of data

    watch: {
        selectedUsers(val) {
            this.$emit("selectUsers", val);
        },
    }, //end of watch

    beforeMount() {
        this.initFilters();
        this.toast = useToast();
    }, //end of beforeMount

    methods: {
        confirmDeleteUser(user) {
            this.user = user;
            this.deleteUserDialog = true;
        }, //end of confirmDeleteUser

        deleteUser() {
            this.loading = true;
            axios
                .delete("/api/admin/users/" + this.user.id)
                .then((response) => {
                    this.toast.add({
                        severity: "success",
                        summary: "Successful",
                        detail: response.data.message,
                        life: 3000,
                    });
                    this.$emit("deleteUser");
                    this.deleteUserDialog = false;
                    this.user = {};
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
                    this.deleteUserDialog = false;
                });
        }, //end of deleteUser

        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            };
        }, //end of initFilters

        exportCSV() {
            this.$refs.dt.exportCSV();
        }, //end of exportCSV

        editUser(user) {
            this.$emit("editUser", user);
        }, //end of editUser
    }, //end of methods
};
</script>

<style scoped lang="scss">
@import "../../../../assets/demo/styles/badges.scss";
</style>
