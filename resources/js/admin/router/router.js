import {createRouter, createWebHistory} from "vue-router";

import apiCookies from "../../api/apiCookies.js";

import authLayout from "../authentication/layout/layout.vue";
import login from "../authentication/pages/login.vue";
import forgot from "../authentication/pages/forgot.vue";
import reset from "../authentication/pages/reset.vue";
import verification from "../authentication/pages/verification.vue";

import portalLayout from "../portal/layout/layout.vue";
import dashboard from "../portal/pages/dashboard.vue";
import users from "../portal/pages/users.vue";
import courses from "../portal/pages/courses.vue";
import sections from "../portal/pages/sections.vue";
import lessons from "../portal/pages/lessons.vue";
import enrollments from "../portal/pages/enrollments.vue";
import quizzes from "../portal/pages/quizzes.vue";
import questions from "../portal/pages/questions.vue";
import answers from "../portal/pages/answers.vue";
import quizAttempts from "../portal/pages/quiz-attempts.vue";
import payments from "../portal/pages/payments.vue";
import comments from "../portal/pages/comments.vue";
import about_us from "../portal/pages/about_us.vue";
import contact_us from "../portal/pages/contact_us.vue";
import profile from "../portal/pages/profile.vue";

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
            { path: 'users', name: 'users', component: users, meta: { title: 'Users' } },
            { path: 'courses', name: 'courses', component: courses, meta: { title: 'Courses' } },
            { path: 'sections', name: 'sections', component: sections, meta: { title: 'Sections' } },
            { path: 'lessons', name: 'lessons', component: lessons, meta: { title: 'Lessons' } },
            { path: 'enrollments', name: 'enrollments', component: enrollments, meta: { title: 'Enrollments' } },
            { path: 'quizzes', name: 'quizzes', component: quizzes, meta: { title: 'Quizzes' } },
            { path: 'questions', name: 'questions', component: questions, meta: { title: 'Questions' } },
            { path: 'answers', name: 'answers', component: answers, meta: { title: 'Answers' } },
            { path: 'quiz-attempts', name: 'quizAttempts', component: quizAttempts, meta: { title: 'Quiz Attempts' } },
            { path: 'payments', name: 'payments', component: payments, meta: { title: 'Payments' } },
            { path: 'comments', name: 'comments', component: comments, meta: { title: 'Comments' } },
            { path: 'about_us', name: 'about_us', component: about_us, meta: { title: 'About Us' } },
            { path: 'contact_us', name: 'contact_us', component: contact_us, meta: { title: 'Contact Us' } },
            { path: 'profile', name: 'profile', component: profile, meta: { title: 'Profile' } },
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

if(apiCookies.get('role') !== 'admin') {
    apiCookies.remove('user');
    apiCookies.remove('role');
    apiCookies.remove('access_token');
}

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!apiCookies.get('access_token');
    if (to.matched.some(record => record.name === 'authLayout')) {
        if (isAuthenticated) {
            next({name: 'dashboard'});
        } else {
            next();
        }
    } else if (to.matched.some(record => record.name === 'portalLayout')) {
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
