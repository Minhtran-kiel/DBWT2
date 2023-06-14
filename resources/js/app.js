import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
//import SearchArticle from './components/SearchArticle.vue';
import App from './components/App.vue';

//const app1 = createApp({});
//app1.component('search-article', SearchArticle);
//app1.mount('#app');

//Create the router instance
/*const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/header', component: SiteHeader},
        {path: '/body', component: SiteBody},
        {path: '/footer', component: SiteFooter}
    ]
})*/

// Create the Vue app and use the router
const app = createApp(App);
app.mount('#app');


