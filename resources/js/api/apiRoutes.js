const apiRoutes = {

    // auth
    login: '/auth/login',
    registration: '/auth/registration',
    forgot: '/auth/forgot',
    reset: '/auth/reset',
    verification: '/auth/verification',

    // profile
    userDetails: '/profile/user-details',
    changeDetails: '/profile/change-details',
    changePassword: '/profile/change-password',
    logout: '/profile/logout',
    deleteAccount: '/profile/delete-account',
    uploadImage: '/profile/upload-image',
    removeImage: '/profile/remove-image',

    // dashboard
    dashboard: 'dashboard',

    // user
    user: {
        list: '/user/list',
        store: '/user/store',
        show: (id) => `/user/show/${id}`,
        update: (id) => `/user/update/${id}`,
        delete: (id) => `/user/delete/${id}`,
    },

    // course
    course: {
        list: '/course/list',
        store: '/course/store',
        show: (id) => `/course/show/${id}`,
        update: (id) => `/course/update/${id}`,
        delete: (id) => `/course/delete/${id}`,
    },

    // section
    section: {
        list: '/section/list',
        store: '/section/store',
        show: (id) => `/section/show/${id}`,
        update: (id) => `/section/update/${id}`,
        delete: (id) => `/section/delete/${id}`,
    },

    // lesson
    lesson: {
        list: '/lesson/list',
        store: '/lesson/store',
        show: (id) => `/lesson/show/${id}`,
        update: (id) => `/lesson/update/${id}`,
        delete: (id) => `/lesson/delete/${id}`,
    },

    // enrollment
    enrollment: {
        list: '/enrollment/list',
        store: '/enrollment/store',
        show: (id) => `/enrollment/show/${id}`,
        update: (id) => `/enrollment/update/${id}`,
        delete: (id) => `/enrollment/delete/${id}`,
    },

    // quiz
    quiz: {
        list: '/quiz/list',
        store: '/quiz/store',
        show: (id) => `/quiz/show/${id}`,
        update: (id) => `/quiz/update/${id}`,
        delete: (id) => `/quiz/delete/${id}`,
    },

    // answer
    answer: {
        list: '/answer/list',
        store: '/answer/store',
        show: (id) => `/answer/show/${id}`,
        update: (id) => `/answer/update/${id}`,
        delete: (id) => `/answer/delete/${id}`,
    },

    // comment
    comment: {
        list: '/comment/list',
        store: '/comment/store',
        show: (id) => `/comment/show/${id}`,
        update: (id) => `/comment/update/${id}`,
        delete: (id) => `/comment/delete/${id}`,
    },

    // payment
    payment: {
        list: '/payment/list',
        store: '/payment/store',
        show: (id) => `/payment/show/${id}`,
        update: (id) => `/payment/update/${id}`,
        delete: (id) => `/payment/delete/${id}`,
    },

    // question
    question: {
        list: '/question/list',
        store: '/question/store',
        show: (id) => `/question/show/${id}`,
        update: (id) => `/question/update/${id}`,
        delete: (id) => `/question/delete/${id}`,
    },

    // quiz attempt
    quizAttempt: {
        list: '/quiz-attempt/list',
        store: '/quiz-attempt/store',
        show: (id) => `/quiz-attempt/show/${id}`,
        update: (id) => `/quiz-attempt/update/${id}`,
        delete: (id) => `/quiz-attempt/delete/${id}`,
    },

    // settings
    settings: {
        list: '/settings/list',
        store: '/settings/store',
        show: (id) => `/settings/show/${id}`,
        update: (id) => `/settings/update/${id}`,
        delete: (id) => `/settings/delete/${id}`,
    },

}

export default apiRoutes;
