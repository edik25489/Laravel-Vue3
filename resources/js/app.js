import "./bootstrap";
import {createApp} from "vue";
import Welcome from "./layouts/Welcome.vue";
import router from "./router";
import store from "./store/index.js";

createApp(Welcome)
    .use(store)
    .use(router)
    .mount("#app");
