import {createRouter, createWebHistory} from "vue-router";

import authLayout from "../authentication/layout/layout.vue";
import login from "../authentication/pages/login.vue";
import forgot from "../authentication/pages/forgot.vue";
import reset from "../authentication/pages/reset.vue";
import verification from "../authentication/pages/verification.vue";

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
