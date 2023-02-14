<template>
    <div
        v-for="x in [1, 2, 3]"
        :key="x"
        class="m-1 px-5 py-4 pt-2 bg-white rounded-lg shadow animate-pulse flex gap-3"
    >
        <div class="flex items-start w-full mt-4 space-x-3">
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
            <div class="w-full">
                <div class="h-2.5 bg-gray-200 rounded-full w-32 mb-2"></div>
                <div class="w-48 h-2 bg-gray-200 rounded-full"></div>
                <div class="pt-2">
                    <div
                        class="h-2.5 bg-gray-200 rounded-full w-full mb-2.5"
                    ></div>
                    <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                    <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                </div>
            </div>
        </div>

        <span class="sr-only">Loading...</span>
    </div>
</template>

<script setup></script>

<style></style>
