import "bootstrap/dist/css/bootstrap.min.css"
import { createApp } from "vue";
import { createPinia } from "pinia";
import axios from "./plugins/axios";
import auth from "./plugins/auth";
import VueAxios from 'vue-axios'

import App from "./App.vue";
import router from "./router";

const app = createApp(App);


app.use(createPinia());
app.use(auth);
app.use(router);
app.use(VueAxios, axios)



app.mount("#app");
import "bootstrap/dist/js/bootstrap.min.js"
