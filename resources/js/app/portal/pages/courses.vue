<template>

    <section class="w-full object-cover bg-center" :style="{ backgroundImage: 'url(/collection/breadcrumb-background.jpg)' }">
        <div class="w-full bg-black/45">
            <div class="max-w-7xl mx-auto w-full">
                <div class="min-h-[250px] max-h-[250px] w-full flex justify-center items-center flex-col">
                    <div class="mb-1 inline-block text-xl text-white font-medium">
                        Courses
                    </div>
                    <div class="flex justify-center items-center gap-5">
                        <RouterLink :to="{name:'home'}" class="inline-block decoration-0 text-white font-medium">
                            Home
                        </RouterLink>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                        <RouterLink :to="{name:'courses'}" class="inline-block decoration-0 text-white font-medium">
                            Courses
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full py-16">
        <div class="max-w-7xl mx-auto w-full">

        </div>
    </section>

</template>

<script>

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
