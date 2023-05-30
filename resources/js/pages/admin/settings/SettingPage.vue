<template>
    <Toast />
    <div class="col-12">
        <div class="card">
            <h5 class="mb-5">Seo's</h5>
            <Loading v-if="loading" />
            <div v-else class="p-fluid formgrid grid">
                <div class="field col-12 md:col-6">
                    <span class="p-float-label">
                        <InputText
                            type="text"
                            id="title_en"
                            v-model="title.en"
                            :placeholder="$t('english')"
                        />
                        <label for="title_en">{{ $t("title") }}</label>
                    </span>
                </div>

                <div class="field col-12 md:col-6">
                    <span class="p-float-label">
                        <InputText
                            type="text"
                            id="title_ar"
                            v-model="title.ar"
                            :placeholder="$t('arabic')"
                        />
                        <label for="title_ar">{{ $t("title") }}</label>
                    </span>
                </div>

                <div class="field col-12 md:col-6">
                    <span class="">
                        <label for="description_en">{{
                            $t("description")
                        }}</label>
                    </span>
                    <span class="p-float-label">
                        <Editor
                            id="description_en"
                            v-model="description.en"
                            editorStyle="height: 320px"
                            :modules="$store.getters.getEditorOptions.modules"
                            :placeholder="$t('english')"
                        />
                    </span>
                </div>

                <div class="field col-12 md:col-6">
                    <span class="">
                        <label for="description_ar">{{
                            $t("description")
                        }}</label>
                    </span>
                    <span class="p-float-label">
                        <Editor
                            id="description_ar"
                            v-model="description.ar"
                            editorStyle="height: 320px"
                            :modules="$store.getters.getEditorOptions.modules"
                            :placeholder="$t('arabic')"
                        />
                    </span>
                </div>

                <div class="field col-12 mt-4">
                    <span class="p-float-label">
                        <Chips inputId="chips" v-model="keywords"></Chips>
                        <label for="chips">Chips</label>
                    </span>
                </div>

                <div class="field col-12 mt-4">
                    <div class="flex justify-content-between">
                        <div>
                            <FileUpload
                                mode="basic"
                                accept="image/*"
                                customUpload
                                :maxFileSize="1000000"
                                :chooseLabel="$t('chooseImage')"
                                @change="uploadImage"
                                ref="fileUploader"
                                class="m-0"
                            />
                        </div>
                        <div>
                            <Button
                                icon="pi pi-check"
                                label="Submit"
                                class="p-mt-2 m-0"
                                @click.prevent="updateSeo"
                                :disabled="loading"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useToast } from "primevue/usetoast";

export default {
    data() {
        return {
            title: {
                en: "",
                ar: "",
            },
            description: {
                en: "",
                ar: "",
            },
            keywords: [],
            image: null,
            loading: false,
        };
    }, // end of data

    methods: {
        fill() {
            this.loading = true;
            axios
                .get("/api/admin/seos")
                .then((response) => {
                    this.title.en = response.data.seo.title.en;
                    this.title.ar = response.data.seo.title.ar;
                    this.description.en = response.data.seo.description.en;
                    this.description.ar = response.data.seo.description.ar;
                    this.keywords = response.data.seo.keywords.split(",");
                })
                .catch((error) => {
                    if (error.response) {
                        this.toast.add({
                            severity: "error",
                            summary: "Error",
                            detail: error.response.data.message,
                            life: 15000,
                        });
                    }
                })
                .then(() => {
                    this.loading = false;
                });
        }, // end of fill
        formatKeywords() {
            let stringedKeywords = "";
            this.keywords.forEach((keyword) => {
                stringedKeywords += keyword + ",";
            });
            stringedKeywords = stringedKeywords.slice(0, -1);
            return stringedKeywords;
        }, // end of formatKeywords

        uploadImage() {
            if (this.$refs.fileUploader.files[0]) return;
            this.image = this.$refs.fileUploader.files[0];
        }, // end of onUpload

        updateSeo() {
            this.loading = true;
            const formData = new FormData();
            formData.append("title", JSON.stringify(this.title));
            formData.append("description", JSON.stringify(this.description));
            formData.append("keywords", this.formatKeywords());
            if (this.image) formData.append("image", this.image);
            formData.append("_method", "PUT");
            axios
                .post("/api/admin/seos/1", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.toast.add({
                        severity: "success",
                        summary: "Success",
                        detail: response.data.message,
                        life: 3000,
                    });
                })
                .catch((error) => {
                    if (error.response) {
                        this.toast.add({
                            severity: "error",
                            summary: "Error",
                            detail: error.response.data.message,
                            life: 15000,
                        });
                    }
                })
                .then(() => {
                    this.loading = false;
                });
        }, // end of updateSeo
    }, // end of methods

    beforeMount() {
        this.toast = useToast();
    }, // end of beforeMount

    mounted() {
        this.fill();
    }, // end of mounted
};
</script>
