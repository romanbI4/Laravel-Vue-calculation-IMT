require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('calculate-component', require('./components/CalculateComponent.vue').default);

Vue.use(VueRouter);

function routes() {}

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
