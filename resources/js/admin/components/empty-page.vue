<template>

    <div class="w-full min-h-[calc(100vh-300px)] max-h-[calc(100vh-300px)] rounded-md shadow-lg bg-white p-2.5 flex justify-center items-center flex-col font-medium">
        <div class="mb-1 inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
        </div>
        <div class="mb-3 inline-block text-gray-800">
            {{ message }}
        </div>
        <div class="inline-block text-sm text-gray-600">
            Click " <span class="text-blue-700 cursor-pointer" @click="$emit('add')">ADD</span> " For New {{subMessage}}
        </div>
    </div>

</template>

<script>

export default {
    name: "NoData",
    props: {
        message: {
            type: String,
            default: "No Data Found"
        },
        subMessage: {
            type: String,
            default: "data"
        }
    }
}

</script>
