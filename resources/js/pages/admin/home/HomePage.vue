<template>
  <page-header>Home Page</page-header>
  <loading-ui v-if="loading"></loading-ui>
  <hero-section
    v-if="!loading"
    :errors="errors"
    :heroSectionData="heroSectionData"
    @update-hero-section="updateHeroSection"
  />
</template>

<script>
import HeroSection from "./sections/HeroSection.vue";
export default {
  components: {
    // HeroSection
    HeroSection,
  }, //end of components
  data() {
    return {
      loading: true,
      errors: null,
      heroSectionData: null,
    };
  }, //end of data
  methods: {
    getHomeData() {
      axios
        .get("/api/admin/home-page")
        .then((response) => {
          if (response.status == 200) {
            this.loading = false;
            this.heroSectionData = {
              hero_title: response.data.hero_title,
              hero_description: response.data.hero_description,
              hero_image_url: response.data.hero_image_url,
            };
          }
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .then(() => {
          this.loading = false;
        });
    }, //end of getHomeData
    updateHeroSection(formData) {
      this.loading = true;
      axios
        .post("/api/admin/home-page/hero-section", formData)
        .then((response) => {
          if (response.status == 200) {
            new Noty({
              type: "success",
              layout: "topRight",
              timeout: "2000",
              text: response.data,
            }).show();
            this.getHomeData();
          }
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .then(() => {
          this.loading = false;
        });
    }, //end of submtting the form
  }, //end of methods

  created() {
    this.getHomeData();
  }, //end of created
};
</script>