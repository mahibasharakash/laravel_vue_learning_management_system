<template>

    <section class="w-full object-cover bg-center" :style="{ backgroundImage: 'url(/collection/breadcrumb-background.jpg)' }">
        <div class="w-full bg-black/65">
            <div class="max-w-7xl mx-auto w-full">
                <div class="min-h-[190px] max-h-[190px] w-full flex justify-center items-center flex-col">
                    <div class="mb-3 inline-block text-xl text-white font-semibold">
                        {{ breadcrumbTitle }}
                    </div>
                    <div class="flex justify-center items-center gap-3">
                        <template v-for="(item, index) in breadcrumbItems" :key="index">
                            <RouterLink :to="{ name: item.breadcrumb_link }" class="inline-block decoration-0 text-sm text-white font-medium">
                                {{ item.breadcrumb_text }}
                            </RouterLink>
                            <span v-if="index < breadcrumbItems.length - 1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    name: "Breadcrumb",
    props: {
        breadcrumbTitle: {
            type: String,
            required: true,
        },
        breadcrumbItems: {
            type: Array,
            required: true,
            default: () => [],
        },
    },
};

</script>
