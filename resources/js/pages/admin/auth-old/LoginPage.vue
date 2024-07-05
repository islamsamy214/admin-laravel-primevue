<template>
  <div class="mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Admin Login</div>

            <div class="card-body">
              <form @submit.prevent="submitLogin">
                <div class="form-group row">
                  <label
                    for="email"
                    class="col-md-4 col-form-label text-md-right"
                    >{{$t('email')}}</label
                  >

                  <div class="col-md-6">
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      name="email"
                      required
                      autocomplete="email"
                      v-model="email"
                      autofocus
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <label
                    for="password"
                    class="col-md-4 col-form-label text-md-right"
                    >{{$t('password')}}</label
                  >

                  <div class="col-md-6">
                    <input
                      id="password"
                      type="password"
                      class="form-control"
                      name="password"
                      required
                      v-model="password"
                      autocomplete="current-password"
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                      />

                      <label class="form-check-label" for="remember">
                        Remember Me
                      </label>
                    </div>
                  </div>
                </div>

                <!-- start of error section -->
                <div
                  class="card w-75 mx-auto mb-3 alert alert-danger"
                  v-if="error"
                >
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      {{ error }}
                    </li>
                  </ul>
                </div>
                <!-- end of error section -->

                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button
                      type="submit"
                      class="btn btn-primary"
                      :disabled="isLoading"
                    >
                      Login
                    </button>

                    <button
                      class="btn btn-link"
                      @click.prevent="forgetPassword"
                    >
                      Forgot Your Password?
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../../../store";

export default {
  data() {
    return {
      isLoading: false,
      email: null,
      password: null,
      error: null,
    };
  }, //end of data

  methods: {
    submitLogin() {
      this.isLoading = true;
      this.submitUser();
    }, //end of submit login

    submitUser() {
      axios
        .post("/api/admin/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({ name: "admin.dashboard" });
          }
        })
        .catch((errors) => {
          this.error = errors.response.data.errors.email[0];
        })
        .then(() => {
          this.isLoading = false;
        });
      //end of logging in with axios to the controller
    }, //end of submitUser

    forgetPassword() {
      //relax and try to remember it
    }, //end of forgetPassword
  }, //end of methods
  
  async beforeRouteEnter(to, from, next) {
    // check if authnticated
    try {
      const user = (await axios.get("/api/admin/user")).data;
      store.commit("adminAuth/login", user);
      next({ name: "admin.dashboard" });
    } catch (error) {
      if (error.response.status == 401) {
        next();
        // this.$router.push({ name: "admin-login" });
      }
    }
  },
};
</script>