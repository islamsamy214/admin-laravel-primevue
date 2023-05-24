<template>
    <div>
        <page-header>{{ $t("settings") }}</page-header>
        <loading-ui v-if="pageLoading"></loading-ui>
        <div class="row justify-content-left m-2" v-else>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $t("edit") }} Seo's</div>
                    <div class="card-body">
                        <form
                            @submit.prevent="fillForm"
                            enctype="multipart/form-data"
                        >
                            <div class="form-group row">
                                <label
                                    for="title"
                                    class="col-md-2 col-form-label text-md-right"
                                    >Title</label
                                >
                                <div class="col">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control"
                                        name="title"
                                        required
                                        autocomplete="title"
                                        autofocus
                                        v-model="title.en"
                                    />
                                </div>
                                <div class="col">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control"
                                        name="title"
                                        required
                                        autocomplete="title"
                                        autofocus
                                        v-model="title.ar"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="description"
                                    class="col-md-2 col-form-label text-md-right"
                                    >Description</label
                                >
                                <div class="col-5">
                                    <Editor
                                        v-model="description.en"
                                        editorStyle="height: 320px"
                                    />
                                </div>
                                <div class="col-5">
                                    <Editor
                                        v-model="description.ar"
                                        editorStyle="height: 320px"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="keywords"
                                    class="col-md-2 col-form-label text-md-right"
                                    >Keywords</label
                                >

                                <div class="col">
                                    <textarea
                                        id="keywords"
                                        type="text"
                                        class="form-control"
                                        name="keywords"
                                        required
                                        autocomplete="description"
                                        v-model="keywords"
                                    ></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="image"
                                    class="col-md-2 col-form-label text-md-right"
                                    >{{ $t("image") }}</label
                                >

                                <div class="col">
                                    <input
                                        id="image"
                                        type="file"
                                        class="form-control"
                                        name="image"
                                        autocomplete="description"
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
                                        v-if="errors.title"
                                    >
                                        <div
                                            v-for="error in errors.title"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item"
                                        v-if="errors.description"
                                    >
                                        <div
                                            v-for="error in errors.description"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item"
                                        v-if="errors.keywords"
                                    >
                                        <div
                                            v-for="error in errors.keywords"
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
    data() {
        return {
            pageLoading: true,
            title: null,
            description: null,
            keywords: null,
            image: null,
            errors: null,
        };
    }, //end of data

    methods: {
        uploadImage(event) {
            this.image = event.currentTarget.files[0];
        }, //end of image upload
        fill() {
            axios
                .get(`/api/admin/seos`)
                .then((response) => {
                    this.title = response.data.seo.title;
                    this.description = response.data.seo.description;
                    this.keywords = response.data.seo.keywords;
                })
                .then(() => {
                    this.pageLoading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        fillForm() {
            let formData = new FormData();
            formData.append("title", JSON.stringify(this.title));
            formData.append("description", JSON.stringify(this.description));
            formData.append("keywords", this.keywords);
            formData.append("_method", "PUT");
            if (this.image) {
                formData.append("image", this.image);
            }
            this.submitClient(formData);
        }, //end of filling form

        submitClient(formData) {
            axios
                .post(`/api/admin/seos/1`, formData)
                .then((response) => {
                    if (response.status == 200) {
                        new Noty({
                            type: "success",
                            layout: "topRight",
                            timeout: "2000",
                            text:
                                this.$t("updated") + " " + this.$t("settings"),
                        }).show();
                        this.errors = null;
                    }
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                });
        }, //end of submtting the form
    }, //end of mehtods

    mounted() {
        this.fill();
    }, //end of created
};
</script>
