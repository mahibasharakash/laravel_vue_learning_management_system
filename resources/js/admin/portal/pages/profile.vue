<template>

    <!-- breadcrumb -->
    <div class="w-full bg-white rounded-md px-6 py-3 flex justify-start gap-3">
        <a href="javascript:void(0)" class="decoration-0 text-black inline-block font-medium text-md">
            Profile
        </a>
    </div>
    <!-- / breadcrumb -->

</template>

<script>

export default {
    data() {
        return {
            // data properties
            isActiveManageModal: false,
            isActiveDeleteModal: false,
            formData: {
                name: '',
                email: '',
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
