<template>

    <!-- form -->
    <form class="w-full">

        <!-- email -->
        <div class="mb-4 w-full block">
            <label for="email" class="form-label"> Email </label>
            <input id="email" type="email" name="email" class="form-control" required autocomplete="off" />
        </div>
        <!-- / email -->

        <!-- button -->
        <div class="mb-4 w-full block">
            <button type="submit" class="btn-theme">
                Send
            </button>
        </div>
        <!-- / button -->

        <!-- link -->
        <div class="text-center text-sm font-medium">
            !Remember Password
            <br/>
            <RouterLink :to="{name:'login'}" class="underline text-blue-400 duration-500 hover:text-blue-700 text-sm"> Login </RouterLink>
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
