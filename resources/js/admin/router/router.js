import {createRouter, createWebHistory} from "vue-router";

import authLayout from "../authentication/layout/layout.vue";
import login from "../authentication/pages/login.vue";
import forgot from "../authentication/pages/forgot.vue";
import reset from "../authentication/pages/reset.vue";
import verification from "../authentication/pages/verification.vue";

import portalLayout from "../portal/layout/layout.vue";
import dashboard from "../portal/pages/dashboard.vue";

const routes = [
    { path: '/admin/auth', name: 'authLayout', component: authLayout,
        children: [
            { path: 'login', name: 'login', component: login, meta: { title: + 'Login' } },
            { path: 'forgot', name: 'forgot', component: forgot, meta: { title: + 'Forgot' } },
            { path: 'reset', name: 'reset', component: reset, meta: { title: + 'Reset' } },
            { path: 'verification', name: 'verification', component: verification, meta: { title: + 'Verification' } },
        ]
    },
    {
        path: '/admin', name: 'portalLayout', component: portalLayout,
        children: [
            { path: '', name: 'dashboard', component: dashboard, meta: { title: 'Dashboard' } },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(), routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth',
            };
        } else {
            return {top: 0, behavior: 'smooth'};
        }
    }
});

export default router;
