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
        {path: '/unit/images', component: () => import('./views/unit/Images')},

        {path: '/experiments/stream', component: () => import('./views/experiments/Stream')},

        {path: '/garbage/map', component: () => import('./views/garbage/Map')},
        {path: '/garbage/bd', component: () => import('./views/garbage/Database')},
        {path: '/garbage/docs', component: () => import('./views/garbage/Docs')},
        {path: '/garbage/plan', component: () => import('./views/garbage/Plan')},
        {path: '/garbage/theory', component: () => import('./views/garbage/Theory')},

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
