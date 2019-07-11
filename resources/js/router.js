import VueRouter from 'vue-router';

export default new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: () => import('./views/Home')},
        {path: '/system', component: () => import('./views/TestSystem')},
        {path: '/tokens', component: () => import('./views/Tokens')},

        {path: '/components', component: () => import('./views/UI')},
        {path: '/grid', component: () => import('./views/GridTest')},
    ]
});