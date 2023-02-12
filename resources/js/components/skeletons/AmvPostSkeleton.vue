<template>
    <div
        v-for="x in count"
        :key="x"
        class="px-5 py-4 pt-2 bg-white rounded-lg shadow animate-pulse flex flex-col gap-3"
    >
        <div class="flex items-center mt-4 space-x-3">
            <svg
                class="text-gray-200 w-14 h-14"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                    clip-rule="evenodd"
                ></path>
            </svg>
            <div>
                <div class="h-2.5 bg-gray-200 rounded-full w-32 mb-2"></div>
                <div class="w-48 h-2 bg-gray-200 rounded-full"></div>
            </div>
        </div>

        <div>
            <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
            <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full"></div>
        </div>

        <div
            role="status"
            class="flex mb-5 items-center justify-center h-56 w-full bg-gray-300 rounded-lg animate-pulse"
        >
            <svg
                class="w-12 h-12 text-gray-200"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 384 512"
            >
                <path
                    d="M361 215C375.3 223.8 384 239.3 384 256C384 272.7 375.3 288.2 361 296.1L73.03 472.1C58.21 482 39.66 482.4 24.52 473.9C9.377 465.4 0 449.4 0 432V80C0 62.64 9.377 46.63 24.52 38.13C39.66 29.64 58.21 29.99 73.03 39.04L361 215z"
                />
            </svg>
            <span class="sr-only">Loading video...</span>
        </div>
        <div class="flex gap-3 justify-between">
            <div class="h-8 bg-gray-200 w-24 mb-4 rounded"></div>
            <div class="h-8 bg-gray-200 w-24 mb-4 rounded"></div>
            <div class="h-8 bg-gray-200 w-24 mb-4 rounded"></div>
            <div class="h-8 bg-gray-200 w-24 mb-4 rounded"></div>
        </div>

        <span class="sr-only">Loading...</span>
    </div>
</template>

<script setup>
const props = defineProps(["count"]);
</script>

<style></style>
