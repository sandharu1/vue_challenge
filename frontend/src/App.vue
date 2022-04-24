<script setup>
import Navbar from "@/components/layout/Navbar.vue";
import { RouterLink, RouterView } from "vue-router";
// import Sidebar from "@/components/layout/Sidebar.vue";
</script>

<template>
  <div class="container-fluid">
    <Navbar />
    <!-- <Sidebar /> -->
    <RouterView />
  </div>
</template>
