<template>
  <div>
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img
              src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
              class="img-fluid"
              alt="Sample image"
            />
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form v-on:submit.prevent="onSubmit">
              <div
                class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start"
              >
                <h2 class="lead fw-normal mb-6 me-3">Sign in</h2>
                <!-- <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-linkedin-in"></i>
                </button> -->
              </div>

              <!-- <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0">Or</p>
              </div> -->

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input
                  type="email"
                  id="form3Example1"
                  class="form-control form-control-lg"
                  placeholder="Enter a valid email address"
                  v-model="credentials.email"
                />
                <label class="form-label" for="form3Example1">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-3">
                <input
                  type="password"
                  id="form3Example4"
                  class="form-control form-control-lg"
                  placeholder="Enter password"
                  v-model="credentials.password"
                />
                <label class="form-label" for="form3Example4">Password</label>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input
                    class="form-check-input me-2"
                    type="checkbox"
                    value=""
                    id="form2Example2"
                    v-model="credentials.remember_me"
                  />
                  <label class="form-check-label" for="form2Example2">
                    Remember me
                  </label>
                </div>
                <a href="#!" class="text-body">Forgot password?</a>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button
                  type="submit"
                  :disabled="loading"
                  class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem"
                >
                  <div
                    v-if="loading"
                    class="spinner-border mx-3 spinner-border-sm"
                    role="status"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <span v-else>Login</span>
                </button>

                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Don't have an account?
                  <RouterLink to="/register" class="link-danger">Sign-up</RouterLink>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onBeforeUnmount } from "vue";
import { useRouter } from "vue-router";
import { authStore } from "../../stores/auth";
import { errorStore } from "../../stores/error";

const loading = ref(false);
const credentials = ref({});
const router = useRouter();
const auth = authStore();
const error = errorStore();

const onSubmit = () => {
  loading.value = !loading.value;

  authStore()
    .login(credentials.value)
    .then(() => router.push({ name: "dashboard" }))
    .catch(() => (loading.value = !loading.value));
};

onBeforeUnmount(() => error.$reset());
</script>

<style lang="scss" scoped></style>
