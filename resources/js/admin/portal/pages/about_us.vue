<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start items-center gap-3 shadow-lg">
        <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black inline-block font-medium text-md">
            Dashboard
        </RouterLink>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mb-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </div>
        <RouterLink :to="{name:'about_us'}" class="decoration-0 text-black inline-block font-medium text-md">
            About Us
        </RouterLink>
    </div>
    <!-- / breadcrumb -->

    <!-- update -->
    <div class="w-full mt-3 flex justify-end gap-5">
        <button type="button" class="text-sm cursor-pointer duration-500 min-w-[100px] max-w-[100px] min-h-[48px] max-h-[48px] inline-flex justify-center items-center rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white">
            Update
        </button>
    </div>
    <!-- / update -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/api/apiRoutes.js";
import apiServices from "@/api/apiServices.js";
import apiCookies from "@/api/apiCookies.js";

export default {
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

    }
}

</script>
