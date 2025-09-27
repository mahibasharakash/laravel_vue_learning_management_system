<template>

    <!-- admin panel -->
    <section class="flex items-start">

        <!-- sidebar -->
        <aside class="min-w-[290px] bg-white fixed lg:static top-0 bottom-0 duration-500 shadow-lg lg:shadow-none z-50" @click.stop :class="{ 'start-0' : isSidebarActive, '-start-[290px]' : !isSidebarActive }">

            <!-- sidebar header -->
            <div class="min-h-[80px] w-full flex justify-center items-center text-xl px-5">
                <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black inline-block font-medium">
                    Admin Panel
                </RouterLink>
            </div>
            <!-- / sidebar header -->

            <!-- sidebar body -->
            <div class="min-h-[calc(100vh-160px)] p-5 overflow-y-auto">

                <!-- link -->
                <RouterLink :to="{name: 'dashboard'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'dashboard', 'bg-transparent text-gray-700' : $route.name !== 'dashboard' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    </span>
                    Dashboard
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'users'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'users', 'bg-transparent text-gray-700' : $route.name !== 'users' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </span>
                    Users
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'courses'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'courses', 'bg-transparent text-gray-700' : $route.name !== 'courses' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </span>
                    Courses
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'sections'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'sections', 'bg-transparent text-gray-700' : $route.name !== 'sections' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                    </span>
                    Sections
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'lessons'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'lessons', 'bg-transparent text-gray-700' : $route.name !== 'lessons' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                    </span>
                    Lessons
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'enrollments'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'enrollments', 'bg-transparent text-gray-700' : $route.name !== 'enrollments' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>
                    </span>
                    Enrollments
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'quizzes'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'quizzes', 'bg-transparent text-gray-700' : $route.name !== 'quizzes' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                        </svg>
                    </span>
                    Quizzes
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'questions'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'questions', 'bg-transparent text-gray-700' : $route.name !== 'questions' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </span>
                    Questions
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'answers'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'answers', 'bg-transparent text-gray-700' : $route.name !== 'answers' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>
                    </span>
                    Answers
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'quizAttempts'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'quizAttempts', 'bg-transparent text-gray-700' : $route.name !== 'quizAttempts' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                        </svg>
                    </span>
                    Quiz Attempts
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'payments'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'payments', 'bg-transparent text-gray-700' : $route.name !== 'payments' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </span>
                    Payments
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'comments'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'comments', 'bg-transparent text-gray-700' : $route.name !== 'comments' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="min-w-5 min-h-5 max-w-5 max-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                    </span>
                    Comments
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'about_us'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'about_us', 'bg-transparent text-gray-700' : $route.name !== 'about_us' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                        </svg>
                    </span>
                    About Us
                </RouterLink>
                <!-- / link -->

                <!-- link -->
                <RouterLink :to="{name: 'contact_us'}" class="decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'contact_us', 'bg-transparent text-gray-700' : $route.name !== 'contact_us' }" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                    </span>
                    Contact Us
                </RouterLink>
                <!-- / link -->

            </div>
            <!-- / sidebar body -->

            <!-- sidebar footer -->
            <div class="p-2">

                <!-- button logout -->
                <button type="button" class="cursor-pointer min-h-[63px] max-h-[63px] flex justify-center items-center rounded-lg bg-gray-100 w-full text-sm duration-500 hover:bg-blue-600 text-gray-700 hover:text-white font-medium gap-3" @click="closeSidebar()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                        </svg>
                    </span>
                    Logout
                </button>
                <!-- / button logout -->

            </div>
            <!-- / sidebar footer -->

        </aside>
        <!-- / sidebar -->

        <!-- content -->
        <main class="min-w-full lg:min-w-[calc(100%-290px)]">

            <!-- header -->
            <header class="w-full px-5 flex justify-between items-center min-h-[80px] max-h-[80px] gap-5 bg-white">
                <div class="lg:invisible">
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 rounded-full cursor-pointer hover:bg-blue-600 hover:text-white duration-500" @click.stop="openSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                    </button>
                </div>
                <div class="flex justify-end items-center gap-2">
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 rounded-full cursor-pointer hover:bg-blue-600 hover:text-white duration-500" @click="sizeControlToggle()">
                        <template v-if="!isSizeControl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                        </template>
                        <template v-if="isSizeControl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                            </svg>
                        </template>
                    </button>
                    <div class="relative">
                        <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 rounded-full cursor-pointer hover:bg-blue-600 hover:text-white duration-500" @click.stop="dropdownToggle()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </button>
                        <div class="absolute top-auto mt-2 end-0 min-w-[150px] overflow-hidden duration-500 border-gray-300 rounded-md" :class="{ 'max-h-0 border-0' : !isDropDownActive, 'max-h-[350px] border' : isDropDownActive }" @click.stop>
                            <div class="bg-white p-1.5 w-full">
                                <RouterLink :to="{name:'profile'}" class="cursor-pointer w-full decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5" :class="{ 'bg-blue-600 text-white' : $route.name === 'profile', 'bg-transparent text-gray-700' : $route.name !== 'profile' }" @click="dropdownToggle();closeSidebar()">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                        </svg>
                                    </span>
                                    Profile
                                </RouterLink>
                                <button type="button" class="cursor-pointer w-full decoration-0 flex justify-start items-center hover:bg-blue-600 hover:text-white py-3 px-4.5 duration-500 rounded-md text-sm font-medium gap-3 mb-0.5 text-gray-700" v-if="!logoutLoading" @click="closeSidebar();logoutApi()">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                                        </svg>
                                    </span>
                                    Logout
                                </button>
                                <button type="button" class="btn-theme w-full" v-if="logoutLoading">
                                    <span class="btn-loading-white"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- / header -->

            <!-- main -->
            <main class="w-full p-5 block min-h-[calc(100vh-80px)] max-h-[calc(100vh-80px)] overflow-y-auto">
                <RouterView></RouterView>
            </main>
            <!-- / main -->

        </main>
        <!-- / content -->

    </section>
    <!-- / admin panel -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/api/apiRoutes.js";
import apiServices from "@/api/apiServices.js";
import apiCookies from "@/api/apiCookies.js";

export default {
    data() {
        return {
            // data properties
            isSizeControl: false,
            isDropDownActive: false,
            logoutLoading: false,
            isSidebarActive: false,
        }
    },
    mounted() {
        // data mounted
        window.addEventListener('click', (event) => this.handleOutSideClickDropdown());
        window.addEventListener('click', (event) => this.handleOutSideClickSidebar());
    },
    beforeUnmount() {
        // data before unmount
        window.removeEventListener('click', (event) => this.handleOutSideClickDropdown());
        window.removeEventListener('click', (event) => this.handleOutSideClickSidebar());
    },
    methods: {

        // size control toggle
        sizeControlToggle() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                this.isSizeControl = true;
            } else {
                document.exitFullscreen();
                this.isSizeControl = false;
            }
        },

        // dropdown toggle
        dropdownToggle() {
            this.isDropDownActive = !this.isDropDownActive;
        },

        // handle outside click dropdown
        handleOutSideClickDropdown() {
            if(this.isDropDownActive) {
                this.isDropDownActive = false;
            }
        },

        // open sidebar
        openSidebar() {
            this.isSidebarActive = true;
        },

        // close sidebar
        closeSidebar() {
            this.isSidebarActive = false;
        },

        // handle outside click sidebar
        handleOutSideClickSidebar() {
            if(this.isSidebarActive) {
                this.isSidebarActive = false;
            }
        },

        async logoutApi() {
            try {
                this.logoutLoading = true;
                await axios.post(apiRoutes.logout, null, {headers: apiServices.headerContent});
                apiCookies.remove('access_token', null);
                apiCookies.remove('role', null);
                apiCookies.remove('user', null);
                this.$router.push({name:'login'});
            } finally {
                this.logoutLoading = false;
            }
        }

    }
}

</script>
