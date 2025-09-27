<template>

    <!-- form -->
    <form @submit.prevent="verificationApi()" class="w-full">

        <!-- email -->
        <div class="mb-3 w-full block">
            <label for="verification_code" class="form-label"> Verification Code </label>
            <input id="verification_code" type="text" name="verification_code" v-model="formData.verification_code" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.verification_code"> {{error?.verification_code[0]}} </div>
        </div>
        <!-- / email -->

        <!-- button -->
        <div class="mb-3 w-full block">
            <button type="submit" class="btn-theme min-w-[120px] max-w-[120px]" v-if="!loading">
                Verify
            </button>
            <button type="button" class="btn-theme min-w-[120px] max-w-[120px]" v-if="loading">
                <span class="btn-loading-white"></span>
            </button>
        </div>
        <!-- / button -->

        <!-- button -->
        <div class="text-center text-sm font-medium">
            !Remember Password
            <br/>
            <RouterLink :to="{name:'login'}" class="underline text-blue-400 duration-500 hover:text-blue-700 text-sm">
                Login
            </RouterLink>
        </div>
        <!-- button -->

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
                verification_code: '',
            },
            error: {},
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        // verification api implementation
        async verificationApi() {
            try {
                this.error = {};
                this.loading = true;
                await axios.post(apiRoutes.verification, this.formData, {headers: apiServices.headerContent});
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
