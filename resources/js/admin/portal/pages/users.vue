<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start gap-3 shadow-lg">
        <a href="javascript:void(0)" class="decoration-0 text-black inline-block font-medium text-md">
            Users
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
                                Name
                            </th>
                            <th class="min-w-[250px] max-w-[250px] py-3 px-3.5 text-start text-sm font-medium">
                                Email
                            </th>
                            <th class="min-w-[120px] max-w-[120px] py-3 px-3.5 text-start text-sm font-medium">
                                Role
                            </th>
                            <th class="min-w-[150px] max-w-[150px] py-3 px-3.5 text-start text-sm font-medium">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <!-- / table data header -->

                    <!-- table data body -->
                    <tbody class="w-full">
                        <tr class="w-full bg-transparent duration-500 hover:bg-gray-200" v-for="(each, index) in tableData" :key="index">
                            <td class="min-w-[250px] max-w-[250px] py-3 px-3.5 text-gray-600 text-start text-sm font-medium">
                                {{each.name}}
                            </td>
                            <td class="min-w-[250px] max-w-[250px] py-3 px-3.5 text-gray-600 text-start text-sm font-medium">
                                {{each.email}}
                            </td>
                            <td class="min-w-[120px] max-w-[120px] py-3 px-3.5 text-gray-600 text-start text-sm font-medium">
                                {{each.role}}
                            </td>
                            <td class="min-w-[150px] max-w-[150px] py-3 px-3.5 text-start">
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
        <template v-if="tableData.length === 0 && !listLoading">
            <div class="w-full min-h-[calc(100vh-300px)] max-h-[calc(100vh-300px)] rounded-md shadow-lg bg-white p-2.5 flex justify-center items-center flex-col font-medium">
                <div class="mb-1 inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </div>
                <div class="mb-3 inline-block text-gray-800">
                    No Data Found
                </div>
                <div class="inline-block text-sm text-gray-600">
                    Click " <span class="text-blue-700">ADD</span> " For New Data
                </div>
            </div>
        </template>
        <!-- / no data found -->

        <!-- loading -->
        <template v-if="listLoading">
            <div class="w-full min-h-[calc(100vh-300px)] max-h-[calc(100vh-300px)] rounded-md shadow-lg bg-white p-2.5 flex justify-center items-center font-medium">
                <span class="w-18 h-18 rounded-full border-6 border-b-transparent border-blue-600 animate-spin"></span>
            </div>
        </template>
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
                Showing {{ tableData.length }} to {{ pagination.total }}
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
                        User
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

                    <!-- upload image -->
                    <div class="mb-3 w-ful block">
                        <div v-if="attach_preview" class="w-full relative rounded-md min-h-[200px] max-h-[200px] overflow-hidden">
                            <img :src="attach_preview" class="w-full object-contain bg-contain max-h-[200px] min-h-[200px]" alt="upload-image" />
                            <div class="absolute inset-0 flex justify-center items-center">
                                <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-red-500 cursor-pointer text-white hover:bg-red-700 rounded-full" @click="removeFile()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <label v-else for="upload-image" class="w-full flex justify-center items-center flex-col gap-2 rounded-md min-h-[200px] max-h-[200px] bg-gray-200 duration-500 hover:bg-gray-400 shadow-inner cursor-pointer">
                            <input type="file" name="image" id="upload-image" @change="attachFile($event)" hidden="hidden" />
                            <span class="inline-block mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                            </span>
                            <span class="text-xs font-semibold">
                                Max 500Kbs Upload File
                            </span>
                            <span class="text-xs font-medium">
                                Upload Image
                            </span>
                        </label>
                    </div>
                    <!-- / upload image -->

                    <!-- name -->
                    <div class="mb-3 w-full block">
                        <label for="name" class="form-label"> Name </label>
                        <input id="name" type="text" name="name" v-model="formData.name" class="form-control" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.name"> {{error?.name[0]}} </div>
                    </div>
                    <!-- / name -->

                    <!-- email -->
                    <div class="mb-3 w-full block">
                        <label for="email" class="form-label"> Email </label>
                        <input id="email" type="email" name="email" v-model="formData.email" class="form-control" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.email"> {{error?.email[0]}} </div>
                    </div>
                    <!-- / email -->

                    <!-- password -->
                    <div class="mb-3 w-full block">
                        <label for="password" class="form-label"> Password </label>
                        <input id="password" type="password" name="password" v-model="formData.password" class="form-control" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.password"> {{error?.password[0]}} </div>
                    </div>
                    <!-- / password -->

                    <!-- password confirmation -->
                    <div class="mb-3 w-full block">
                        <label for="password_confirmation" class="form-label"> Password Confirmation </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" v-model="formData.password_confirmation" class="form-control" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.password_confirmation"> {{error?.password_confirmation[0]}} </div>
                    </div>
                    <!-- / password confirmation -->

                    <!-- role -->
                    <div class="mb-3 w-full block">
                        <label for="role" class="form-label"> Role </label>
                        <div class="w-full relative">
                            <select name="role" id="role" v-model="formData.role" class="form-select" autocomplete="off">
                                <option :value="null"> Select Role </option>
                                <option :value="'instructor'"> instructor </option>
                                <option :value="'student'"> student </option>
                            </select>
                            <div class="absolute top-0 bottom-0 end-0 pe-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.role"> {{error?.role[0]}} </div>
                    </div>
                    <!-- / role -->

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
            showLoading: false,
            listLoading: false,
            attach_preview: null,
            error: {},
            formData: {
                image: null,
                id: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role: null, // admin instructor student
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
                last_page: 0
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
                this.showApi(data);
            } else {
                this.attach_preview = null;
                this.formData = {
                    image: null,
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role: null,
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

        // list api implementation
        async listApi() {
            try {
                this.listLoading = true;
                const response = await axios.get(apiRoutes.user.list, {params: this.params}, {headers: apiServices.headerContent});
                this.tableData = response?.data?.data;
                this.pagination = response?.data?.pagination;
            } finally {
                this.listLoading = false;
            }
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

        // attach file
        attachFile(e) {
            this.attach_preview = URL.createObjectURL(e.target.files[0]);
            this.formData.image = e.target.files[0];
        },

        // remove file
        removeFile() {
            this.attach_preview = null;
            this.formData.image = null;
        },

        // manage api
        manageApi() {
            if(this.formData.id) {
                this.updateApi();
            } else {
                this.createApi();
            }
        },

        // create api implementation
        async createApi() {
            try {
                this.manageLoading = true;
                this.error = {};
                let formData = new FormData();
                formData.append('name', this.formData.name);
                formData.append('email', this.formData.email);
                formData.append('password', this.formData.password);
                formData.append('password_confirmation', this.formData.password_confirmation);
                formData.append('role', this.formData.role);
                if (this.formData.image) {
                    formData.append("image", this.formData.image);
                }
                await axios.post(apiRoutes.user.store, formData, { headers: apiServices.mediaHeaderContent });
                this.formData = { image: null, id: '', name: '', email: '', password: '', password_confirmation: '', role: null };
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
                formData.append('name', this.formData.name);
                formData.append('email', this.formData.email);
                formData.append('password', this.formData.password);
                formData.append('password_confirmation', this.formData.password_confirmation);
                formData.append('role', this.formData.role);
                if (this.formData.image) {
                    formData.append("image", this.formData.image);
                }
                await axios.put(apiRoutes.user.update(this.formData.id), formData, { headers: apiServices.mediaHeaderContent });
                this.formData = { image: null, id: '', name: '', email: '', password: '', password_confirmation: '', role: null };
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
                const response = await axios.get(apiRoutes.user.show(data), { headers: apiServices.headerContent });
                this.formData = response?.data?.user;
                this.attach_preview = `/storage/${response?.data?.user?.image}`;
            } finally {
                this.showLoading = false;
            }
        },

        // delete api implementation
        async deleteApi() {
            try {
                this.deleteLoading = true;
                await axios.delete(apiRoutes.user.delete(this.formData.id), { headers: apiServices.headerContent });
                await this.listApi();
                this.closeDeleteModal();
            } finally {
                this.deleteLoading = false;
            }
        },

    }
}

</script>
