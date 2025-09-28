<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start gap-3 shadow-lg">
        <a href="javascript:void(0)" class="decoration-0 text-black inline-block font-medium text-md">
            Quiz Attempts
        </a>
    </div>
    <!-- / breadcrumb -->

    <!-- search and create -->
    <div class="w-full mt-3 flex justify-between gap-5">

        <!-- search -->
        <div class="w-full max-w-[380px] relative">
            <div class="absolute top-0 bottom-0 end-0 pe-5 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <input type="search" name="search" class="font-medium text-sm w-full block min-h-[48px] max-h-[48px] rounded-md bg-white outline-0 border-0 px-5 placeholder-black text-black ring-0 focus-within:ring-2 ring-blue-500 duration-500 shadow-lg" placeholder="Search Here" required autocomplete="off" />
        </div>
        <!-- / search -->

        <!-- create -->
        <button type="button" class="text-sm cursor-pointer duration-500 min-w-[100px] max-w-[100px] min-h-[48px] max-h-[48px] inline-flex justify-center items-center rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white" @click="openManageModal()">
            Create
        </button>
        <!-- / create -->

    </div>
    <!-- / search and create -->

    <!-- body -->
    <div class="w-full mt-3">
        <div class="w-full min-h-[calc(100vh-350px)] max-h-[calc(100vh-350px)] rounded-md shadow-lg bg-white">

        </div>
    </div>
    <!-- / body -->

    <!-- pagination & count -->
    <div class="w-full mt-5">
        <div class="w-full flex justify-between items-center flex-wrap">

            <!-- pagination -->
            <div class="flex justify-start items-center gap-1">
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="min-w-3.5 max-w-3.5 min-h-3.5 max-h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    1
                </button>
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    2
                </button>
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    3
                </button>
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    4
                </button>
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    5
                </button>
                <button type="button" class="text-xs font-medium cursor-pointer min-w-[40px] max-w-[40px] min-h-[40px] max-h-[40px] inline-flex justify-center items-center outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white rounded-full duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="min-w-3.5 max-w-3.5 min-h-3.5 max-h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
            <!-- / pagination -->

            <!-- count -->
            <div class="text-gray-800 font-medium min-h-[40px] max-h-[40px] flex items-center justify-end">
                Showing 1 to 10 of 30 entries
            </div>
            <!-- / count -->

        </div>
    </div>
    <!-- / pagination & count -->

    <!-- manage modal -->
    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="{ 'invisible bg-black/35': !isActiveManageModal, 'visible bg-black/65': isActiveManageModal }" @click="isActiveManageModal = false">

        <!-- manage modal body -->
        <aside class="bg-white rounded-xl w-full sm:max-w-[450px] sm:min-w-[450px] px-8 py-5 duration-500 origin-top" :class="{ 'translate-y-0 opacity-100': isActiveManageModal, '-translate-y-1/2 opacity-0': !isActiveManageModal }" @click.stop>

            <!-- form -->
            <form @submit.prevent="manageApi()" class="w-full block">

                <!-- header -->
                <div class="w-full flex justify-between items-center mb-3">
                    <div class="text-xl font-semibold">
                        <template v-if="formData.id"> Edit </template>
                        <template v-else> Create </template>
                        Quiz Attempt
                    </div>
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] bg-transparent duration-500 hover:bg-gray-200 rounded-full inline-flex justify-center items-center cursor-pointer" @click="closeManageModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- / header -->

                <!-- body -->
                <div class="w-full block">

                    <!-- quiz_id -->
                    <div class="mb-3 w-full block">
                        <label for="quiz_id" class="form-label"> Quiz </label>
                        <div class="w-full relative">
                            <select name="quiz_id" id="quiz_id" v-model="formData.quiz_id" class="form-select" autocomplete="off">
                                <option :value="null"> Select Quiz </option>
                            </select>
                            <div class="absolute top-0 bottom-0 end-0 pe-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.quiz_id"> {{error?.quiz_id[0]}} </div>
                    </div>
                    <!-- / quiz_id -->

                    <!-- user_id -->
                    <div class="mb-3 w-full block">
                        <label for="user_id" class="form-label"> User </label>
                        <div class="w-full relative">
                            <select name="user_id" id="user_id" v-model="formData.user_id" class="form-select" autocomplete="off">
                                <option :value="null"> Select User </option>
                            </select>
                            <div class="absolute top-0 bottom-0 end-0 pe-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.user_id"> {{error?.user_id[0]}} </div>
                    </div>
                    <!-- / user_id -->

                    <!-- score -->
                    <div class="mb-3 w-full block">
                        <label for="score" class="form-label"> Score </label>
                        <input id="score" type="text" name="score" v-model="formData.score" class="form-control" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.score"> {{error?.score[0]}} </div>
                    </div>
                    <!-- / score -->

                </div>
                <!-- / body -->

                <!-- footer -->
                <div class="w-full flex justify-end items-center gap-2">
                    <button type="button" class="btn-lighter" @click="closeManageModal()">
                        Cancel
                    </button>
                    <button type="submit" class="btn-theme" v-if="!manageLoading">
                        <template v-if="formData.id"> Update </template>
                        <template v-else> Create </template>
                    </button>
                    <button type="button" class="btn-theme" v-if="manageLoading">
                        <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                    </button>
                </div>
                <!-- / footer -->

            </form>
            <!-- / form -->

        </aside>
        <!-- / manage modal body -->

    </section>
    <!-- / manage modal -->

    <!-- delete modal -->
    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="{ 'invisible bg-black/35': !isActiveDeleteModal, 'visible bg-black/65': isActiveDeleteModal }" @click="isActiveDeleteModal = false">

        <!-- delete modal body -->
        <aside class="bg-white rounded-xl w-full sm:max-w-[450px] sm:min-w-[450px] px-8 py-10 duration-500 origin-top" :class="{ 'translate-y-0 opacity-100': isActiveDeleteModal, '-translate-y-1/2 opacity-0': !isActiveDeleteModal }" @click.stop>

            <!-- form -->
            <form @submit.prevent="deleteApi()" class="w-full block">

                <!-- header -->
                <div class="mb-3 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3" stroke="currentColor" class="w-17 h-17 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>
                <!-- / header -->

                <!-- body -->
                <div class="mb-4 flex justify-center font-medium">
                    Are You Sure?
                </div>
                <!-- / body -->

                <!-- footer -->
                <div class="w-full flex justify-center items-center gap-5">
                    <button type="button" class="min-w-[110px] max-w-[110px] font-medium cursor-pointer bg-gray-200 duration-500 hover:bg-gray-300 px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" @click="closeDeleteModal()">
                        Cancel
                    </button>
                    <button type="submit" class="min-w-[110px] max-w-[110px] font-medium cursor-pointer bg-red-500 duration-500 hover:bg-red-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="!deleteLoading">
                        Confirm
                    </button>
                    <button type="button" class="min-w-[110px] max-w-[110px] font-medium cursor-pointer bg-red-500 duration-500 hover:bg-red-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="deleteLoading">
                        <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                    </button>
                </div>
                <!-- / footer -->

            </form>
            <!-- / form -->

        </aside>
        <!-- / delete modal body -->

    </section>
    <!-- / delete modal -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/api/apiRoutes.js";
import apiServices from "@/api/apiServices.js";
import apiCookies from "@/api/apiCookies.js";

export default {
    data() {
        return {
            // data properties
            isActiveManageModal: false,
            isActiveDeleteModal: false,
            manageLoading: false,
            deleteLoading: false,
            error: {},
            formData: {
                id: '',
                quiz_id: null, // FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
                user_id: null, // FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                score: '',
                attempted_at: '',
            },
            tableData: [],
            params: {
                page: 1,
                per_page: 10,
                search: ''
            },
            pagination: {
                current_page: 1,
                per_page: 10,
                total: 0,
                last_page: 0,
                from: 1,
                to: 10,
                summary: 'Showing 1 to 10 of 30 entries',
            },
        }
    },
    mounted() {

    },
    methods: {

        // open manage modal
        openManageModal() {
            this.isActiveManageModal = true;
        },

        // close manage modal
        closeManageModal() {
            this.isActiveManageModal = false;
        },

        // open manage modal
        openDeleteModal() {
            this.isActiveDeleteModal = true;
        },

        // close manage modal
        closeDeleteModal() {
            this.isActiveDeleteModal = false;
        },

        // manage api
        manageApi() {

        },

        // delete api
        deleteApi() {

        },

    }
}

</script>
