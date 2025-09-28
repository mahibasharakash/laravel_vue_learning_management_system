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
        <RouterLink :to="{name:'profile'}" class="decoration-0 text-black inline-block font-medium text-md">
            Profile
        </RouterLink>
    </div>
    <!-- / breadcrumb -->

    <!-- profile details -->
    <div class="w-full bg-white rounded-md px-6 py-5 flex justify-start gap-3 shadow-lg mt-3">
        <form @submit.prevent="changeDetails()" class="w-full block max-w-[650px]">
            <div class="mb-1 block w-full font-semibold text-md text-gray-900">
                Profile Information
            </div>
            <div class="mb-5 block w-full font-medium text-sm text-gray-600">
                Update your account's profile information and email address.
            </div>
            <div class="w-full block mb-3">
                <label for="name" class="form-label"> Name </label>
                <input id="name" type="text" name="name" v-model="profileData.name" class="form-control" autocomplete="off" />
                <div class="mt-2 text-red-500 block font-medium text-xs" v-if="profileError?.name"> {{profileError?.name[0]}} </div>
            </div>
            <div class="w-full block mb-3">
                <label for="email" class="form-label"> Email </label>
                <input id="email" type="email" name="email" v-model="profileData.email" class="form-control" autocomplete="off" />
                <div class="mt-2 text-red-500 block font-medium text-xs" v-if="profileError?.email"> {{profileError?.email[0]}} </div>
            </div>
            <div class="w-full block mb-3">
                <label for="address" class="form-label"> Address </label>
                <input id="address" type="text" name="address" v-model="profileData.address" class="form-control" autocomplete="off" />
                <div class="mt-2 text-red-500 block font-medium text-xs" v-if="profileError?.address"> {{profileError?.address[0]}} </div>
            </div>
            <div class="w-full">
                <button type="submit" class="btn-theme min-w-[120px] max-w-[120px]" v-if="!changeDetailsLoading">
                    Update
                </button>
                <button type="button" class="btn-theme min-w-[120px] max-w-[120px]" v-if="changeDetailsLoading">
                    <span class="btn-loading-white"></span>
                </button>
            </div>
        </form>
    </div>
    <!-- / profile details -->

    <!-- change password -->
    <div class="w-full bg-white rounded-md px-6 py-5 flex justify-start gap-3 shadow-lg mt-5">
        <form @submit.prevent="changePassword()" class="w-full block max-w-[650px]">
            <div class="mb-1 block w-full font-semibold text-md text-gray-900">
                Update Password
            </div>
            <div class="mb-5 block w-full font-medium text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </div>
            <div class="w-full block mb-3">
                <label for="current_password" class="form-label"> Current Password </label>
                <input id="current_password" type="password" name="current_password" v-model="passwordData.current_password" class="form-control" autocomplete="off" />
                <div class="mt-2 text-red-500 block font-medium text-xs" v-if="passwordError?.current_password"> {{passwordError?.current_password[0]}} </div>
            </div>
            <div class="w-full block mb-3">
                <label for="password" class="form-label"> New Password </label>
                <input id="password" type="password" name="password" v-model="passwordData.password" class="form-control" autocomplete="off" />
                <div class="mt-2 text-red-500 block font-medium text-xs" v-if="passwordError?.password"> {{passwordError?.password[0]}} </div>
            </div>
            <div class="w-full block mb-3">
                <label for="password_confirmation" class="form-label"> Password Confirmation </label>
                <input id="password_confirmation" type="password" name="password_confirmation" v-model="passwordData.password_confirmation" class="form-control" autocomplete="off" />
                <div class="mt-2 text-red-500 block font-medium text-xs" v-if="passwordError?.password_confirmation"> {{passwordError?.password_confirmation[0]}} </div>
            </div>
            <div class="w-full block">
                <button type="submit" class="btn-theme min-w-[120px] max-w-[120px]" v-if="!changePasswordLoading">
                    Update
                </button>
                <button type="button" class="btn-theme min-w-[120px] max-w-[120px]" v-if="changePasswordLoading">
                    <span class="btn-loading-white"></span>
                </button>
            </div>
        </form>
    </div>
    <!-- / change password -->

    <!-- delete account -->
    <div class="w-full bg-white rounded-md px-6 py-5 flex justify-start gap-3 shadow-lg mt-5">
        <form @submit.prevent="deleteAccount()" class="w-full block max-w-[650px]">
            <div class="mb-1 block w-full font-semibold text-md text-gray-900">
                Delete Account
            </div>
            <div class="mb-5 block w-full font-medium text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </div>
            <div class="w-full block">
                <button type="submit" class="btn-danger min-w-[120px] max-w-[120px]" v-if="!deleteAccountLoading">
                    Confirm
                </button>
                <button type="button" class="btn-danger min-w-[120px] max-w-[120px]" v-if="deleteAccountLoading">
                    <span class="btn-loading-white"></span>
                </button>
            </div>
        </form>
    </div>
    <!-- / delete account -->

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
            getDetailsLoading: false,
            changeDetailsLoading: false,
            changePasswordLoading: false,
            deleteAccountLoading: false,
            uploadImageLoading: false,
            removeImageLoading: false,
            profileError: {},
            passwordError: {},
            profileData: {
                name: '',
                email: '',
                address: '',
            },
            passwordData: {
                current_password: '',
                password: '',
                password_confirmation: '',
            },
        }
    },
    mounted() {
        this.getDetails();
    },
    methods: {

        // details
        async getDetails() {
            try {
                this.getDetailsLoading = true;
                const response = await axios.get(apiRoutes.userDetails, this.profileData, {headers: apiServices.headerContent});
                this.profileData = response?.data?.user
            } finally {
                this.getDetailsLoading = false;
            }
        },

        // change details
        async changeDetails() {
            try {
                this.profileError = {};
                this.changeDetailsLoading = true;
                await axios.post(apiRoutes.changeDetails, this.profileData, {headers: apiServices.headerContent});
                await this.getDetails();
            } catch(e) {
                this.profileError = e.response.data.errors;
            } finally {
                this.changeDetailsLoading = false;
            }
        },

        // change password
        async changePassword() {
            try {
                this.passwordError = {};
                this.changePasswordLoading = true;
                await axios.post(apiRoutes.changePassword, this.passwordData, {headers: apiServices.headerContent});
                this.passwordData = { current_password: '', password: '', password_confirmation: '' };
                await this.getDetails();
            } catch(e) {
                this.passwordError = e.response.data.errors;
            } finally {
                this.changePasswordLoading = false;
            }
        },

        // delete account
        async deleteAccount() {
            try {
                this.deleteAccountLoading = true;
                await axios.post(apiRoutes.deleteAccount, null, {headers: apiServices.headerContent});
                apiCookies.remove('access_token');
                apiCookies.remove('user');
                apiCookies.remove('role');
                this.$router.push({name:'login'});
            } catch(e) {

            } finally {
                this.deleteAccountLoading = false;
            }
        },

        // upload image
        async uploadImage() {
            try {
                this.uploadImageLoading = true;
                await axios.post(apiRoutes.uploadImage, null, {headers: apiServices.headerContent});
            } catch(e) {

            } finally {
                this.uploadImageLoading = false;
            }
        },

        // remove image
        async removeImage() {
            try {
                this.removeImageLoading = true;
                await axios.post(apiRoutes.removeImage, null, {headers: apiServices.headerContent});
            } catch(e) {

            } finally {
                this.removeImageLoading = false;
            }
        },

    }
}

</script>
