import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginPage from "../views/pages/Login.vue";
import RegisterPage from "../views/pages/Register.vue";
import DashboardPage from "../views/pages/Dashboard.vue";
import { authStore } from "../stores/auth";
import LogoutPage from "../views/pages/logout.vue";

const redirectToHomeOnLoggedIn = (to, from, next) => {
  console.log(from);
  if (authStore().loggedIn) next({ name: "dashboard" });
  else next();
};

const redirectToLoginNotOnLoggedIn = (to, from, next) => {
  console.log(from);
  if (!authStore().loggedIn) next({ name: "login" });
  else next();
};

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
      beforeEnter: redirectToHomeOnLoggedIn,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: LoginPage,
      beforeEnter: redirectToHomeOnLoggedIn,
    },
    {
      path: "/register",
      name: "register",
      component: RegisterPage,
      beforeEnter: redirectToHomeOnLoggedIn,
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: DashboardPage,
      beforeEnter: redirectToLoginNotOnLoggedIn,
    },
    {
      path: "/logout",
      name: "logout",
      component: LogoutPage,
      beforeEnter: redirectToLoginNotOnLoggedIn,
    }
  ],
});

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth && !authStore().loggedIn)
    next({ name: "login" });
  else next();
});

export default router;
