import { authStore } from "../stores/auth";

export default {
  install: ({ config }) => {
    config.globalProperties.$auth = authStore();

    if (authStore().loggedIn) {
      authStore().ftechUser();
    }
  },
};
