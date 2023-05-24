<template>
  <div>
    <section-header>Hero section</section-header>
    <form @submit.prevent="fillForm" enctype="multipart/form-data">
      <div class="form-group">
        <label for="hero_title">Title</label>
        <input
          type="text"
          class="form-control"
          id="hero_title"
          placeholder="lorem ipsum"
          v-model="hero_title"
        />
      </div>
      <div class="form-group">
        <label for="hero_image">{{$t('image')}}</label>
        <img
          :src="hero_image_url"
          class="rounded mx-auto d-block img-thumbnail img-fluid my-3 mw-100"
          alt="hero image"
          v-if="hero_image_url"
        />
        <input
          type="file"
          class="form-control"
          id="hero_image"
          @change="uploadImage"
        />
      </div>

      <div class="form-group">
        <label for="hero_description">Description</label>
        <textarea
          class="form-control"
          id="hero_description"
          rows="3"
          v-model="hero_description"
        ></textarea>
      </div>

      <div class="card w-75 mx-auto mb-3 alert alert-danger" v-if="errors">
        <ul class="list-group list-group-flush">
          <li class="list-group-item" v-if="errors.hero_title">
            <div v-for="error in errors.hero_title" :key="error">
              {{ error }}
            </div>
          </li>
          <li class="list-group-item" v-if="errors.hero_image">
            <div v-for="error in errors.hero_image" :key="error">
              {{ error }}
            </div>
          </li>
          <li class="list-group-item" v-if="errors.hero_description">
            <div v-for="error in errors.hero_description" :key="error">
              {{ error }}
            </div>
          </li>
        </ul>
      </div>

      <div class="form-group row mb-0 text-right">
        <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary" :disabled="loading">
            Update Hero Section
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["heroSectionData", "errors"],
  emits: ["updateHeroSection"],
  data() {
    return {
      loading: false,
      hero_title: this.heroSectionData.hero_title,
      hero_description: this.heroSectionData.hero_description,
      hero_image_url: this.heroSectionData.hero_image_url,
      hero_image: null,
    };
  }, // end of data
  methods: {
    uploadImage(event) {
      this.hero_image = event.target.files[0];
    }, // end of uploadImage
    fillForm() {
      this.loading = true;
      const formData = new FormData();
      formData.append("hero_title", this.hero_title);
      formData.append("hero_description", this.hero_description);
      if (this.hero_image) {
        formData.append("hero_image", this.hero_image);
      }
      formData.append("_method", "PUT");
      this.$emit("updateHeroSection", formData);
    }, // end of fillForm
  }, // end of methods
  watch: {
    heroSectionData() {
      this.hero_title = this.heroSectionData.hero_title;
      this.hero_description = this.heroSectionData.hero_description;
      this.hero_image_url = this.heroSectionData.hero_image_url;
    },
  }, // end of watch
};
</script>