<template>
  <div>
    <div class="container">
      <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom"
      >
        <a
          href="/"
          class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"
        >
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li>
            <RouterLink to="/" class="nav-link px-2 link-secondary">Home</RouterLink>
          </li>
          <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
          <li>
            <RouterLink to="/about" class="nav-link px-2 link-secondary"
              >About</RouterLink
            >
          </li>
        </ul>

        <div class="col-md-3 text-end">
          <RouterLink to="/login" class="btn btn-outline-primary me-2">Login</RouterLink>
          <RouterLink to="/register" class="btn btn-outline-primary me-2"
            >Sign-up</RouterLink
          >
        </div>
      </header>
    </div>
  </div>
</template>

<script>
export default {
  name: "Test",
  created() {},
  data() {
    return {};
  },
  props: {},
  methods: {},
};
</script>

<style lang="scss" scoped></style>
