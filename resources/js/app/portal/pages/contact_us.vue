<template>

    <Breadcrumb :breadcrumb-title="'Contact Us'" :breadcrumb-items="[ { breadcrumb_text: 'Home', breadcrumb_link: 'home' }, { breadcrumb_text: 'Contact Us', breadcrumb_link: 'contact_us' } ]" />

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
