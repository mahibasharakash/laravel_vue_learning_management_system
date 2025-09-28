<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start gap-3 shadow-lg">
        <a href="javascript:void(0)" class="decoration-0 text-black inline-block font-medium text-md">
            About Us
        </a>
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
