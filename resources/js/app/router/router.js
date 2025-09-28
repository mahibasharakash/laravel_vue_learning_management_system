import {createRouter, createWebHistory} from "vue-router";

import apiCookies from "../../api/apiCookies.js";

import authLayout from "../authentication/layout/layout.vue";
import login from "../authentication/pages/login.vue";
import forgot from "../authentication/pages/forgot.vue";
import reset from "../authentication/pages/reset.vue";
import verification from "../authentication/pages/verification.vue";

import profileLayout from "../profile/layout/layout.vue";
import details from "../profile/pages/details.vue";

import portalLayout from "../portal/layout/layout.vue";
import home from "../portal/pages/home.vue";
import about_us from "../portal/pages/about_us.vue";
import contact_us from "../portal/pages/contact_us.vue";
import instructors from "../portal/pages/instructors.vue";
import courses from "../portal/pages/courses.vue";

const routes = [
    {
        path: '', name: 'portalLayout', component: portalLayout,
        children: [
            { path: '', name: 'home', component: home, meta: { title: 'Home' } },
            { path: 'about_us', name: 'about_us', component: about_us, meta: { title: 'About Us' } },
            { path: 'contact_us', name: 'contact_us', component: contact_us, meta: { title: 'Contact Us' } },
            { path: 'instructors', name: 'instructors', component: instructors, meta: { title: 'Instructors' } },
            { path: 'courses', name: 'courses', component: courses, meta: { title: 'Courses' } },
            { path: 'auth', name: 'authLayout', component: authLayout,
                children: [
                    { path: 'login', name: 'login', component: login, meta: { title: + 'Login' } },
                    { path: 'forgot', name: 'forgot', component: forgot, meta: { title: + 'Forgot' } },
                    { path: 'reset', name: 'reset', component: reset, meta: { title: + 'Reset' } },
                    { path: 'verification', name: 'verification', component: verification, meta: { title: + 'Verification' } },
                ]
            },
            { path: 'profile', name: 'profileLayout', component: profileLayout,
                children: [
                    { path: 'details', name: 'details', component: details, meta: { title: + 'Student Details' } },
                ]
            },
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

if (apiCookies.get('role') !== 'student') {
    apiCookies.remove('user');
    apiCookies.remove('role');
    apiCookies.remove('access_token');
}

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!apiCookies.get('access_token');
    if (to.matched.some(record => record.name === 'authLayout')) {
        if (isAuthenticated) {
            next({name: 'details'});
        } else {
            next();
        }
    } else if (to.matched.some(record => record.name === 'profileLayout')) {
        if (!isAuthenticated) {
            next({name: 'login'});
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
