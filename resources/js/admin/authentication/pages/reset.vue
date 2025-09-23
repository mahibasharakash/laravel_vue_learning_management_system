<template>

    <!-- form -->
    <form class="w-full">

        <!-- email -->
        <div class="mb-4 w-full block">
            <label for="email" class="form-label"> Email </label>
            <input id="email" type="email" name="email" class="form-control" required autocomplete="off" />
        </div>
        <!-- / email -->

        <!-- reset code -->
        <div class="mb-4 w-full block">
            <label for="reset_code" class="form-label"> Reset Code </label>
            <input id="reset_code" type="text" name="reset_code" class="form-control" required autocomplete="off" />
        </div>
        <!-- / reset code -->

        <!-- password -->
        <div class="mb-4 w-full block">
            <label for="password" class="form-label"> Password </label>
            <input id="password" type="password" name="password" class="form-control" required autocomplete="off" />
        </div>
        <!-- / password -->

        <!-- password confirmation -->
        <div class="mb-4 w-full block">
            <label for="password_confirmation" class="form-label"> Password Confirmation </label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="off" />
        </div>
        <!-- / password confirmation -->

        <!-- button -->
        <div class="mb-4 w-full block">
            <button type="submit" class="btn-theme">
                Submit
            </button>
        </div>
        <!-- / button -->

        <!-- link -->
        <div class="text-center text-sm font-medium">
            Remember Password
            <br/>
            <RouterLink :to="{name:'login'}" class="underline text-blue-500 duration-500 hover:text-blue-700 text-sm">
                Login
            </RouterLink>
        </div>
        <!-- / link -->

    </form>
    <!-- / form -->

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
