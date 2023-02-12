<template>
    <div
        class="w-full bg-white border px-2 py-2 sm:px-4 sm:py-3 border-gray-300 flex flex-col justify-between gap-3 rounded-md cursor-pointer"
        @click="showCreate = true"
    >
        <div class="w-full flex items-center text-gray-400 gap-3">
            <img
                :src="'../storage/icons/page.jpg'"
                class="rounded-full w-12 outline-none focus:ring-0 shadow-none"
                alt=""
            />
            <span>Type here ...</span>
            <button
                class="bg-utOrange p-2 text-white sm:w-36 w-24 ml-auto rounded-full"
                type="button"
            >
                Post
            </button>
        </div>
    </div>
    <div
        v-if="showCreate"
        class="fixed top-0 right-0 bottom-0 left-0 bg-black bg-opacity-25 z-50 flex items-center justify-center"
    >
        <div class="w-[550px] pb-2 bg-white rounded-md">
            <CreateForm @hideCreateModel="showCreate = false" />
        </div>
    </div>
    <AmvPostLayout />
</template>

<script setup>
import { ref } from "vue";
import CreateForm from "../home/CreateForm.vue";
import AmvPostLayout from "../Layouts/AmvPostLayout.vue";
const showCreate = ref(false);
</script>

<style></style>
