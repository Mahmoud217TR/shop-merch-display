require('./bootstrap');
window.Vue = require('vue').default;
import { createApp } from 'vue';

let app=createApp({})
app.component('products-component', require('./components/ProductsComponent.vue').default);
app.mount("#app");