require('./bootstrap');
window.Vue = require('vue').default;
import { createApp } from 'vue';
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);


let app=createApp({})
app.component('products-component', require('./components/ProductsComponent.vue').default);
app.component('categories-component', require('./components/CategoriesComponent.vue').default);
app.component('chart-component', require('./components/ChartComponent.vue').default);
app.mount("#app");
