<template>

    <header class="w-full sticky top-0 start-0 end-0 duration-500 bg-gray-100" :class="{ 'shadow-lg' : isScrolled, 'shadow-none' : !isScrolled }">
        <div class="w-full max-w-7xl mx-auto flex justify-between items-center px-7 duration-500" :class="{ 'min-h-[90px] max-h-[90px]' : isScrolled, 'min-h-[70px] max-h-[70px]' : !isScrolled }">
            <RouterLink :to="{name:'home'}" class="decoration-0 text-gray-700 inline-block text-xl font-medium" @click.stop="closeSidebar()">
                Logo
            </RouterLink>
            <div class="lg:hidden">
                <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-200 duration-500 hover:bg-gray-700 text-black hover:text-white cursor-pointer" @click.stop="openSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                </button>
            </div>
            <div class="flex justify-center lg:justify-end items-center flex-col lg:flex-row gap-5 fixed lg:static top-0 bottom-0 bg-white lg:bg-transparent min-w-full sm:min-w-[280px] lg:min-w-auto h-screen lg:h-auto shadow-lg lg:shadow-none duration-500" :class="{ 'end-0' : isSidebarActive, '-end-full sm:end-[-280px]' : !isSidebarActive }" @click.stop>
                <div class="lg:hidden absolute top-0 end-0 p-5">
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-200 duration-500 hover:bg-gray-700 text-black hover:text-white cursor-pointer" @click="closeSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <RouterLink :to="{name:'home'}" :class="{ 'text-blue-700' : $route.name === 'home', 'text-gray-700' : $route.name !== 'home' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    Home
                </RouterLink>
                <RouterLink :to="{name:'about_us'}" :class="{ 'text-blue-700' : $route.name === 'about_us', 'text-gray-700' : $route.name !== 'about_us' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    About Us
                </RouterLink>
                <RouterLink :to="{name:'contact_us'}" :class="{ 'text-blue-700' : $route.name === 'contact_us', 'text-gray-700' : $route.name !== 'contact_us' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    Contact Us
                </RouterLink>
                <RouterLink :to="{name:'instructors'}" :class="{ 'text-blue-700' : $route.name === 'instructors', 'text-gray-700' : $route.name !== 'instructors' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    Instructors
                </RouterLink>
                <RouterLink :to="{name:'courses'}" :class="{ 'text-blue-700' : $route.name === 'courses', 'text-gray-700' : $route.name !== 'courses' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    Courses
                </RouterLink>
                <RouterLink v-if="!profileData" :to="{name:'login'}" :class="{ 'text-blue-700' : $route.name === 'login', 'text-gray-700' : $route.name !== 'login' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    Login
                </RouterLink>
                <RouterLink v-if="profileData" :to="{name:'details'}" :class="{ 'text-blue-700' : $route.name === 'details', 'text-gray-700' : $route.name !== 'details' }" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium" @click="closeSidebar()">
                    {{profileData?.name}}
                </RouterLink>
                <a v-if="profileData" class="decoration-0 duration-500 hover:text-blue-700 inline-block text-sm font-medium cursor-pointer" @click="logoutApi()">
                    Logout
                </a>
            </div>
        </div>
    </header>

</template>

<script>

import axios from "axios";

import apiRoutes from "@/api/apiRoutes.js";
import apiServices from "@/api/apiServices.js";
import apiCookies from "@/api/apiCookies.js";

export default {
    data() {
        return {
            isScrolled: false,
            isSidebarActive: false,
            profileData: JSON.parse(apiCookies.get('user')) || null,
            cookieUser: apiCookies.get('user') || null,
        }
    },
    watch: {
        cookieUser(newVal) {
            this.profileData = newVal ? JSON.parse(newVal) : null;
        }
    },
    mounted() {
        this.cookieInterval = setInterval(() => {
            const currentCookie = apiCookies.get('user');
            if (currentCookie !== this.cookieUser) {
                this.cookieUser = currentCookie;
            }
        }, 500);
        window.addEventListener('scroll', this.handleScroll);
        window.addEventListener('click', (event) => this.handleOutSideClick());
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
        window.removeEventListener('click', (event) => this.handleOutSideClick());
        clearInterval(this.cookieInterval);
    },
    methods: {

        handleScroll() {
            this.isScrolled = window.scrollY > 20;
        },

        handleOutSideClick() {
            if(this.isSidebarActive) {
                this.isSidebarActive = false;
            }
        },

        openSidebar() {
            this.isSidebarActive = true;
        },

        closeSidebar() {
            this.isSidebarActive = false;
        },

        // logout api implementation
        async logoutApi() {
            try {
                this.logoutLoading = true;
                await axios.post(apiRoutes.logout, null, { headers: apiServices.headerContent });
                apiCookies.remove("access_token");
                apiCookies.remove("user");
                apiCookies.remove("role");
                this.profileData = null;
                this.$router.push({ name: "login" });
            } catch (e) {
                console.error(e);
            } finally {
                this.logoutLoading = false;
            }
        },

    }
}

</script>
