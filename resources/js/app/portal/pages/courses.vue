<template>

    <Breadcrumb :breadcrumb-title="'Courses'" :breadcrumb-items="[ { breadcrumb_text: 'Home', breadcrumb_link: 'home' }, { breadcrumb_text: 'Courses', breadcrumb_link: 'courses' } ]" />

    <section class="w-full py-16">
        <div class="max-w-7xl mx-auto w-full">
            <div class="w-full grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-3 gap-5">
                <template v-for="(each, index) in 3" :key="index">
                    <div class="w-full">
                        <div class="rounded-lg w-full shadow-xl border border-gray-100 bg-gray-100 group">
                            <div class="rounded-lg w-full min-h-[300px] max-h-[300px] overflow-hidden">
                                <img :src="'/collection/breadcrumb-background.jpg'" class="w-full min-h-[300px] max-h-[300px] object-cover bg-cover" alt="course" />
                            </div>
                            <div class="w-full px-5 pt-5 text-xl font-semibold">
                                <div class="text-truncate-line-2">
                                    Offline Course On Advance Excel & Power BI
                                </div>
                            </div>
                            <div class="w-full px-5 pb-5 pt-3 text-sm text-gray-500">
                                <div class="text-truncate-line-3">
                                    ডেটা অ্যানালিটিক্স এবং রিপোর্টিং স্কিলের চাহিদা দিনে দিনে বেড়েই চলেছে। এখন দেশি, বিদেশি, ছোট-বড় প্রায় সব কোম্পানি, ডেটা-ফোকাসড প্রফেশনাল চায়। স্কিলড লার্নাররা সহজেই হাই-পেইড জব, ফ্রিল্যান্সিং প্রজেক্ট বা বিজনেস ডিসিশন-সাপোর্ট রোল পেয়ে যাচ্ছেন। আপনি যদি চান এই ট্রেন্ডে পিছিয়ে না পড়তে তাহলে এখনই এনরোল করুন Advanced Excel & Power BI Offline Course-এ।
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap pb-3">
                                <div class="w-1/2 px-5 pb-3 text-sm font-medium">
                                    1291 Joined
                                </div>
                                <div class="w-1/2 px-5 pb-3 text-sm font-medium">
                                    276+ Lessons
                                </div>
                                <div class="w-1/2 px-5 pb-3 text-sm font-medium">
                                    12+ Assignments
                                </div>
                                <div class="w-1/2 px-5 pb-3 text-sm font-medium">
                                    12+ Projects
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
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
