<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start gap-3 shadow-lg">
        <a href="javascript:void(0)" class="decoration-0 text-black inline-block font-medium text-md">
            Profile
        </a>
    </div>
    <!-- / breadcrumb -->

    <!-- profile details -->
    <div class="w-full bg-white rounded-md px-6 py-5 flex justify-start gap-3 shadow-lg mt-3">
        <form class="w-full block max-w-[650px]">
            <div class="mb-1 block w-full font-semibold text-md text-gray-900">
                Profile Information
            </div>
            <div class="mb-5 block w-full font-medium text-sm text-gray-600">
                Update your account's profile information and email address.
            </div>
            <div class="w-full block mb-3">
                <label for="name" class="form-label"> Name </label>
                <input id="name" type="text" name="name" class="form-control" autocomplete="off" />
            </div>
            <div class="w-full block mb-3">
                <label for="email" class="form-label"> Email </label>
                <input id="email" type="email" name="email" class="form-control" autocomplete="off" />
            </div>
            <div class="w-full block mb-3">
                <label for="address" class="form-label"> Address </label>
                <input id="address" type="text" name="address" class="form-control" autocomplete="off" />
            </div>
            <div class="w-full">
                <button type="submit" class="btn-theme">
                    Update
                </button>
            </div>
        </form>
    </div>
    <!-- / profile details -->

    <!-- change password -->
    <div class="w-full bg-white rounded-md px-6 py-5 flex justify-start gap-3 shadow-lg mt-3">
        <form class="w-full block max-w-[650px]">
            <div class="mb-1 block w-full font-semibold text-md text-gray-900">
                Update Password
            </div>
            <div class="mb-5 block w-full font-medium text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </div>
            <div class="w-full block mb-3">
                <label for="current_password" class="form-label"> Current Password </label>
                <input id="current_password" type="password" name="current_password" class="form-control" autocomplete="off" />
            </div>
            <div class="w-full block mb-3">
                <label for="new_password" class="form-label"> New Password </label>
                <input id="new_password" type="password" name="new_password" class="form-control" autocomplete="off" />
            </div>
            <div class="w-full block mb-3">
                <label for="password_confirmation" class="form-label"> Password Confirmation </label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="off" />
            </div>
            <div class="w-full block">
                <button type="submit" class="btn-theme">
                    Update
                </button>
            </div>
        </form>
    </div>
    <!-- / change password -->

    <!-- delete account -->
    <div class="w-full bg-white rounded-md px-6 py-5 flex justify-start gap-3 shadow-lg mt-3">
        <form class="w-full block max-w-[650px]">
            <div class="mb-1 block w-full font-semibold text-md text-gray-900">
                Delete Account
            </div>
            <div class="mb-5 block w-full font-medium text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </div>
            <div class="w-full block">
                <button type="submit" class="btn-danger">
                    Confirm
                </button>
            </div>
        </form>
    </div>
    <!-- / delete account -->

</template>

<script>

export default {
    data() {
        return {
            // data properties
            isActiveManageModal: false,
            isActiveDeleteModal: false,
            manageLoading: false,
            deleteLoading: false,
            error: {},
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

    },
    methods: {

    }
}

</script>
