<template>

    <!-- form -->
    <form @submit.prevent="forgotApi()" class="w-full">

        <!-- email -->
        <div class="mb-4 w-full block">
            <label for="email" class="form-label"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="form-control" autocomplete="off" />
            <div class="mt-2 text-red-500 block font-medium text-xs" v-if="error?.email"> {{error?.email[0]}} </div>
        </div>
        <!-- / email -->

        <!-- button -->
        <div class="mb-4 w-full block">
            <button type="submit" class="btn-theme min-w-[120px] max-w-[120px]" v-if="!loading">
                Send
            </button>
            <button type="button" class="btn-theme min-w-[120px] max-w-[120px]" v-if="loading">
                <span class="btn-loading-white"></span>
            </button>
        </div>
        <!-- / button -->

        <!-- link -->
        <div class="text-center text-sm font-medium">
            !Remember Password
            <br/>
            <RouterLink :to="{name:'login'}" class="underline text-blue-400 duration-500 hover:text-blue-700 text-sm"> Login </RouterLink>
        </div>
        <!-- / link -->

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
            },
            error: {},
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        // forgot api implementation
        async forgotApi() {
            try {
                this.error = {};
                this.loading = true;
                await axios.post(apiRoutes.forgot, this.formData, {headers: apiServices.headerContent});
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
