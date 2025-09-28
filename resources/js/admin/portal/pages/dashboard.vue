<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start gap-3 shadow-lg">
        <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black inline-block font-medium text-md">
            Dashboard
        </RouterLink>
    </div>
    <!-- / breadcrumb -->

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
