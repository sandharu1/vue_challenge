<template>
  <div class="col text-center">
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="lead">Please wait...</div>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { onMounted } from "@vue/runtime-core";
import { authStore } from "../../stores/auth";

const auth = authStore();
const router = useRouter();

document.title = `Please wait...`;

onMounted(() => auth.logout().then(() => router.push({ name: "login" })));
</script>
