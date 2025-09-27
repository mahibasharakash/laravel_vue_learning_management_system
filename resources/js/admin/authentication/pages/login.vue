<template>

    <!-- form -->
    <form @submit.prevent="loginApi()" class="w-full">

        <!-- email -->
        <div class="mb-4 w-full block">
            <label for="email" class="form-label"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.email"> {{error?.email[0]}} </div>
        </div>
        <!-- / email -->

        <!-- password -->
        <div class="mb-4 w-full block">
            <label for="password" class="form-label"> Password </label>
            <input id="password" type="password" name="password" v-model="formData.password" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.password"> {{error?.password[0]}} </div>
        </div>
        <!-- / password -->

        <!-- remember me -->
        <div class="mb-4 w-full block">
            <label for="remember-me" class="w-full flex justify-start items-center cursor-pointer">
                <input type="checkbox" name="remember-me" id="remember-me" class="peer hidden" />
                <span class="border border-gray-300 bg-gray-300 w-5 h-5 rounded-md inline-flex justify-center items-center peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white [&>svg]:hidden peer-checked:[&>svg]:block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-2.5 h-2.5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </span>
                <span class="ms-2 text-sm font-medium">Remember Me</span>
            </label>
        </div>
        <!-- / remember me -->

        <div class="w-full flex justify-between items-center">

            <!-- button -->
            <button type="submit" class="btn-theme min-w-[120px] max-w-[120px]" v-if="!loading">
                Login
            </button>
            <button type="button" class="btn-theme min-w-[120px] max-w-[120px]" v-if="loading">
                <span class="btn-loading-white"></span>
            </button>
            <!-- / button -->

            <!-- link -->
            <RouterLink :to="{name:'forgot'}" class="font-medium underline text-red-400 duration-500 hover:text-red-700 text-sm">
                Forgot Your Password?
            </RouterLink>
            <!-- / link -->

        </div>

    </form>
    <!-- / form -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/api/apiRoutes.js";
import apiServices from "@/api/apiServices.js";
import apiCookies from "@/api/apiCookies.js";

export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
                role: 'admin',
            },
            error: {},
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        // login api implementation
        async loginApi() {
            try {
                this.error = {};
                this.loading = true;
                await axios.post(apiRoutes.login, this.formData, {headers: apiServices.headerContent});
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
