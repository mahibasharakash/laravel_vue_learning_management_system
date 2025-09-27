<template>

    <Breadcrumb :breadcrumb-title="'Courses'" :breadcrumb-items="[ { breadcrumb_text: 'Home', breadcrumb_link: 'home' }, { breadcrumb_text: 'Courses', breadcrumb_link: 'courses' } ]" />

    <section class="w-full py-16">
        <div class="max-w-7xl mx-auto w-full">

        </div>
    </section>

</template>

<script>

import Breadcrumb from "../../components/breadcrumb.vue";

export default {
    components: {
        Breadcrumb
    },
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
