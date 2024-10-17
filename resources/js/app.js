import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from "vue-router";
import { routes } from "./routes";
import 'bootstrap/dist/css/bootstrap.min.css';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css';
import App from './App.vue';
import store from './components/store';
import { createStore } from 'vuex';
//import Articlestore from './components/store/modules/produitFeature';
import createPersistedState from 'vuex-persistedstate';
import "@fortawesome/fontawesome-free/css/all.css";

//import vuex from './vuex';
//import store from './store'

let app = createApp(App)

const router = createRouter({
history: createWebHashHistory(),
routes: routes,
})
app.use(router).use(PrimeVue);
app.use(router);
app.use(store)

app.mount("#app")
router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.isAuth)) {
    let token = localStorage.getItem('token');
    if (!token) {
    next("/login");
    } else {
    console.log(token);
    next(); // Mettre next() ici après avoir vérifié l'authentification
    }
    } else {
    next(); // Mettre next() ici si la route n'a pas besoin d'authentification
    }
    });
    /*export default createStore({
        modules: {
        
            Articlestore
        
        },
        plugins: [createPersistedState()],
        })*/