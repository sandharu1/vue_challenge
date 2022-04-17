<template>
  <div>
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img
              src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw1.webp"
              class="img-fluid"
              alt="Sample image"
            />
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form v-on:submit.prevent="onSubmit">
              <div
                class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start"
              >
                <h2 class="lead fw-normal mb-4 me-3">Sign up</h2>
              </div>

              <!-- Name input -->
              <div class="form-outline mb-4">
                <input
                  type="text"
                  id="form3Example2"
                  class="form-control form-control-lg"
                  placeholder="Enter your full name"
                  v-model="credentials.name"
                />
                <label class="form-label" for="form3Example2">Full name</label>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input
                  type="email"
                  id="form3Example3"
                  class="form-control form-control-lg"
                  placeholder="Enter a valid email address"
                  v-model="credentials.email"
                />
                <label class="form-label" for="form3Example3">Email address</label>
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

              <div class="form-outline mb-3">
                <input
                  type="password"
                  id="form3Example5"
                  class="form-control form-control-lg"
                  placeholder="Enter password again"
                  v-model="credentials.password_confirmation"
                />
                <label class="form-label" for="form3Example5">Confirm Password</label>
              </div>

              <div class="col-sm-12">
                <pre>{{ credentials }}</pre>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button
                  type="submit"
                  class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem"
                >
                  Sign up
                </button>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Already have an account?
                  <RouterLink to="/login" class="link-danger">Login</RouterLink>
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
    .register(credentials.value)
    .then(() => router.push({ name: "dashboard" }))
    .catch(() => (loading.value = !loading.value));
};

onBeforeUnmount(() => error.$reset());
</script>

<style lang="scss" scoped></style>
