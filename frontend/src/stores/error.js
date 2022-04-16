import { defineStore } from "pinia";

export const errorStore = defineStore("error", {
  state: () => ({
    message: null,
    errors: {},
  }),
});
