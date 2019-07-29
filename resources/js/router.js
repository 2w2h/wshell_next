import VueRouter from 'vue-router';

export default new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: () => import('./views/Home')},
        {path: '/system', component: () => import('./views/TestSystem')},
        {path: '/tokens', component: () => import('./views/Tokens')},

        {path: '/components', component: () => import('./views/UI')},
        {path: '/grid', component: () => import('./views/GridTest')},

        {path: '/unit/dashboard', component: () => import('./views/unit/Dashboard')},

        // { path: '/',         name: 'news',     component: News },
        // { path: '/nabla',    name: 'nabla',    component: Nabla },
        // { path: '/chapters', name: 'chapters', component: Chapters },

        // { path: '/profile',        name: 'common', component: Common },
        // { path: '/profile/files',  name: 'files', component: Files },
        // { path: '/profile/keys',   name: 'keys',   component: Keys },
        // { path: '/profile/groups', name: 'groups', component: Groups },
        // { path: '/profile/chains', name: 'chains', component: Chains },
    ]
});
