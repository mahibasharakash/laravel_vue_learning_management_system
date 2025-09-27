<template>

    <!-- form -->
    <form @submit.prevent="resetApi()" class="w-full">

        <!-- email -->
        <div class="mb-4 w-full block">
            <label for="email" class="form-label"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.email"> {{error?.email[0]}} </div>
        </div>
        <!-- / email -->

        <!-- reset code -->
        <div class="mb-4 w-full block">
            <label for="reset_code" class="form-label"> Reset Code </label>
            <input id="reset_code" type="text" name="reset_code" v-model="formData.reset_code" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.reset_code"> {{error?.reset_code[0]}} </div>
        </div>
        <!-- / reset code -->

        <!-- password -->
        <div class="mb-4 w-full block">
            <label for="password" class="form-label"> Password </label>
            <input id="password" type="password" name="password" v-model="formData.password" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.password"> {{error?.password[0]}} </div>
        </div>
        <!-- / password -->

        <!-- password confirmation -->
        <div class="mb-4 w-full block">
            <label for="password_confirmation" class="form-label"> Password Confirmation </label>
            <input id="password_confirmation" type="password" name="password_confirmation" v-model="formData.password_confirmation" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.password_confirmation"> {{error?.password_confirmation[0]}} </div>
        </div>
        <!-- / password confirmation -->

        <!-- button -->
        <div class="mb-4 w-full block">
            <button type="submit" class="btn-theme min-w-[120px] max-w-[120px]" v-if="!loading">
                Reset
            </button>
            <button type="button" class="btn-theme min-w-[120px] max-w-[120px]" v-if="loading">
                <span class="btn-loading-white"></span>
            </button>
        </div>
        <!-- / button -->

        <!-- link -->
        <div class="text-center text-sm font-medium">
            Remember Password
            <br/>
            <RouterLink :to="{name:'login'}" class="underline text-blue-500 duration-500 hover:text-blue-700 text-sm">
                Login
            </RouterLink>
        </div>
        <!-- / link -->

    </form>
    <!-- / form -->

</template>

<script>

import apiRoutes from "@/api/apiRoutes.js";
import apiServices from "@/api/apiServices.js";
import apiCookies from "@/api/apiCookies.js";

export default {
    data() {
        return {
            formData: {
                email: '',
                reset_code: '',
                password: '',
                password_confirmation: '',
            },
            error: {},
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        // reset api implementation
        resetApi() {
            try {

            } catch (e) {

            } finally {

            }
        }

    }
}

</script>
