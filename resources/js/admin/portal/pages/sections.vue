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
        <RouterLink :to="{name:'sections'}" class="decoration-0 text-black inline-block font-medium text-md">
            Sections
        </RouterLink>
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
            <input type="search" name="search" v-model="params.search" @input="searchData()" class="font-medium text-sm w-full block min-h-[48px] max-h-[48px] rounded-md bg-white outline-0 border-0 px-5 placeholder-black text-black ring-0 focus-within:ring-2 ring-blue-500 duration-500 shadow-lg" placeholder="Search Here" required autocomplete="off" />
        </div>
        <!-- / search -->

        <!-- create -->
        <button type="button" class="text-sm cursor-pointer duration-500 min-w-[100px] max-w-[100px] min-h-[48px] max-h-[48px] inline-flex justify-center items-center rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-800 text-white" @click="openManageModal(null)">
            Create
        </button>
        <!-- / create -->

    </div>
    <!-- / search and create -->

    <!-- body -->
    <div class="w-full mt-3">

        <!-- table data list -->
        <template v-if="tableData.length > 0 && !listLoading">
            <div class="w-full min-h-[calc(100vh-300px)] max-h-[calc(100vh-300px)] rounded-md shadow-lg bg-white p-2.5 overflow-x-auto">
                <table class="table table-auto w-full">

                    <!-- table data header -->
                    <thead class="w-full">
                    <tr class="w-full">
                        <th class="min-w-[250px] max-w-[250px] py-3 px-3.5 text-start text-sm font-medium">
                            Course
                        </th>
                        <th class="min-w-[250px] max-w-[250px] py-3 px-3.5 text-start text-sm font-medium">
                            Title
                        </th>
                        <th class="min-w-[150px] max-w-[150px] py-3 px-3.5 text-start text-sm font-medium">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <!-- / table data header -->

                    <!-- table data body -->
                    <tbody class="w-full">
                    <tr class="w-full bg-transparent duration-500 hover:bg-blue-50 overflow-hidden" v-for="(each, index) in tableData" :key="index">
                        <td class="min-w-[250px] max-w-[250px] py-3 px-3.5 text-gray-800 text-start text-sm font-medium">
                            {{each?.course?.title}}
                        </td>
                        <td class="min-w-[120px] max-w-[120px] py-3 px-3.5 text-gray-800 text-start text-sm font-medium">
                            {{each?.title}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] py-3 px-3.5 text-start rounded-e-md">
                            <div class="flex justify-start items-center gap-3">
                                <button type="button" class="cursor-pointer p-0 m-0 decoration-0 text-gray-700 text-sm font-medium" @click="openManageModal(each.id)">
                                    Edit
                                </button>
                                <button type="button" class="cursor-pointer p-0 m-0 decoration-0 text-red-500 text-sm font-medium" @click="openDeleteModal(each.id)">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <!-- / table data body -->

                </table>
            </div>
        </template>
        <!-- / table data list -->

        <!-- no data found -->
        <emptyPage message="No Users Available" subMessage="user" @add="openManageModal(null)" v-if="tableData.length === 0 && !listLoading"></emptyPage>
        <!-- / no data found -->

        <!-- loading -->
        <loadingPage v-if="listLoading"></loadingPage>
        <!-- / loading -->

    </div>
    <!-- / body -->

    <!-- pagination & count -->
    <div class="w-full mt-5" v-if="tableData.length > 0">
        <div class="w-full flex justify-between items-center flex-wrap">

            <!-- pagination -->
            <div class="flex justify-start items-center gap-1">

                <!-- Previous button -->
                <button type="button" :disabled="pagination.current_page <= 1" @click="goToPage(pagination.current_page - 1)" class="disabled:bg-blue-300 cursor-pointer rounded-full min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- Page buttons -->
                <button v-for="page in getPageRange()" :key="page" type="button" @click="goToPage(page)" :class="[ 'cursor-pointer rounded-full min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center duration-500', page === pagination.current_page ? 'bg-blue-700 text-white' : 'bg-blue-400 text-white hover:bg-blue-700' ]">
                    {{ page }}
                </button>

                <!-- Next button -->
                <button type="button" :disabled="pagination.current_page >= pagination.last_page" @click="goToPage(pagination.current_page + 1)" class="disabled:bg-blue-300 cursor-pointer rounded-full min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

            </div>
            <!-- / pagination -->

            <!-- count -->
            <div class="text-gray-800 font-medium min-h-[40px] max-h-[40px] flex items-center justify-end">
                {{pagination.summary}}
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
                        Section
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

                    <!-- course -->
                    <div class="mb-3 w-full block">
                        <label for="course_id" class="form-label"> Course </label>
                        <div class="w-full relative">
                            <select name="course_id" id="course_id" v-model="formData.course_id" class="form-select" autocomplete="off">
                                <option :value="null"> Select Course </option>
                                <option v-for="(each,index) in courseData" :key="index" :value="each.id"> {{each.title}} </option>
                            </select>
                            <div class="absolute top-0 bottom-0 end-0 pe-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.course_id"> {{error?.course_id[0]}} </div>
                    </div>
                    <!-- / course -->

                    <!-- title -->
                    <div class="mb-3 w-full block">
                        <label for="title" class="form-label"> Title </label>
                        <input id="title" type="text" name="title" v-model="formData.title" class="form-control" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.title"> {{error?.title[0]}} </div>
                    </div>
                    <!-- / title -->

                </div>
                <!-- / body -->

                <!-- footer -->
                <div class="w-full flex justify-end items-center gap-2">
                    <button type="button" class="btn-lighter min-w-[105px] max-w-[105px]" @click="closeManageModal()">
                        Cancel
                    </button>
                    <button type="submit" class="btn-theme min-w-[105px] max-w-[105px]" v-if="!manageLoading">
                        <template v-if="formData.id"> Update </template>
                        <template v-else> Create </template>
                    </button>
                    <button type="button" class="btn-theme min-w-[105px] max-w-[105px]" v-if="manageLoading">
                        <span class="btn-loading-white"></span>
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
                    <button type="button" class="btn-lighter min-w-[115px] max-w-[115px]" @click="closeDeleteModal()">
                        Cancel
                    </button>
                    <button type="submit" class="btn-danger min-w-[115px] max-w-[115px]" v-if="!deleteLoading">
                        Confirm
                    </button>
                    <button type="button" class="btn-danger min-w-[115px] max-w-[115px]" v-if="deleteLoading">
                        <span class="btn-loading-white"></span>
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

import emptyPage from "../../components/empty-page.vue";
import loadingPage from "../../components/loading-page.vue";

import apiRoutes from "../../../api/apiRoutes.js";
import apiServices from "../../../api/apiServices.js";

export default {
    components: {
        emptyPage, loadingPage
    },
    data() {
        return {
            // data properties
            isActiveManageModal: false,
            isActiveDeleteModal: false,
            manageLoading: false,
            deleteLoading: false,
            listLoading: false,
            error: {},
            formData: {
                id: '',
                course_id: null, // FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
                title: '',
            },
            courseData: [],
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
        this.listApi();
    },
    methods: {

        // open manage modal
        openManageModal(data = null) {
            this.error = {};
            if(data) {
                this.showApi(data)
            } else {
                this.formData = {
                    course_id: null,
                    title: '',
                }
            }
            this.isActiveManageModal = true;
        },

        // close manage modal
        closeManageModal() {
            this.error = {};
            this.isActiveManageModal = false;
        },

        // open manage modal
        openDeleteModal(data) {
            this.formData.id = data;
            this.isActiveDeleteModal = true;
        },

        // close manage modal
        closeDeleteModal() {
            this.isActiveDeleteModal = false;
        },

        // search data
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.params.page = 1;
                this.listApi();
            }, 500);
        },

        // page change
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.params.page = page;
                this.listApi();
            }
        },

        // Generate max 5-page buttons
        getPageRange() {
            const total = this.pagination.last_page || 1;
            let start = this.pagination.current_page - 2;
            let end = this.pagination.current_page + 2;
            if (start < 1) { start = 1; end = Math.min(5, total); }
            if (end > total) { end = total; start = Math.max(total - 4, 1); }
            const range = [];
            for (let i = start; i <= end; i++) { range.push(i); }
            return range;
        },

        // manage api
        manageApi() {
            if(this.formData.id) {
                this.updateApi();
            } else {
                this.createApi();
            }
        },

        // list api implementation
        async listApi() {
            try {
                this.listLoading = true;
                const response = await axios.get(apiRoutes.section.list, {params: this.params}, {headers: apiServices.headerContent});
                this.courseData = response?.data?.course;
                this.tableData = response?.data?.data;
                this.pagination = response?.data?.pagination;
            } finally {
                this.listLoading = false;
            }
        },

        // create api implementation
        async createApi() {
            try {
                this.manageLoading = true;
                this.error = {};
                let formData = new FormData();
                formData.append('course_id', this.formData.course_id);
                formData.append('title', this.formData.title);
                await axios.post(apiRoutes.section.store, formData, { headers: apiServices.headerContent });
                this.formData = { course_id: '', title: '' };
                await this.listApi();
                this.closeManageModal();
            } catch (e) {
                this.error = e?.response?.data?.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        // update api implementation
        async updateApi() {
            try {
                this.manageLoading = true;
                let formData = new FormData();
                formData.append('course_id', this.formData.course_id);
                formData.append('title', this.formData.title);
                formData.append('_method', 'PUT')
                await axios.post(apiRoutes.section.update(this.formData.id), formData, { headers: apiServices.mediaHeaderContent });
                this.formData = { instructor_id: '', title: '', description: '', price: '', status: '', thumbnail: '' };
                await this.listApi();
                this.closeManageModal();
            } catch (e) {
                this.error = e?.response?.data?.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        // show api implementation
        async showApi(data) {
            try {
                this.showLoading = true;
                const response = await axios.get(apiRoutes.section.show(data), { headers: apiServices.headerContent });
                this.formData = response?.data?.data;
            } finally {
                this.showLoading = false;
            }
        },

        // delete api implementation
        async deleteApi() {
            try {
                this.deleteLoading = true;
                await axios.delete(apiRoutes.section.delete(this.formData.id), { headers: apiServices.headerContent });
                await this.listApi();
                this.closeDeleteModal();
            } finally {
                this.deleteLoading = false;
            }
        },

    }
}

</script>
