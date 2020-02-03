import Map from "./components/Map";

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import App from "./components/App";
import * as VueGoogleMaps from 'vue2-google-maps'
import EventComponent from "./components/EventComponent";

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyAt_3NhLXBAXsL0uLNLU_9ktApfdFwieZs',
        libraries: 'places'
    },

    installComponents: true
})

Vue.use(VueRouter)

Vue.component('App', App)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    { path: '/', component: Map },
    { path: '/event/:id', component: EventComponent }
]

const router = new VueRouter({
    routes
})


const app = new Vue({
    router,
    VueGoogleMaps,
    el: '#app'
});
