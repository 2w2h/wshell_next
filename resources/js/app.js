import('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import App from './components/App';

Vue.use(VueRouter);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);
Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);
Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
