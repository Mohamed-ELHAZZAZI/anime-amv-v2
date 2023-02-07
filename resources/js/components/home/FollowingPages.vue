<template>
    <div
        class="w-full bg-white text-prussianBlue rounded-md overflow-hidden border border-gray-300"
    >
        <ul class="w-full">
            <li class="w-full h-16 px-5">
                <span
                    class="h-full w-full flex items-center justify-between text-xl capitalize font-semibold"
                >
                    {{ title }}
                </span>
            </li>
            <li
                class="w-full h-20 border-t border-t-gray-300"
                v-for="page in pages"
                :key="page.id"
            >
                <router-link
                    to="/"
                    class="w-full h-full flex items-center gap-5 px-5"
                >
                    <img :src="page.img" class="rounded-full w-14" alt="" />
                    <span class="flex flex-col">
                        <span class="font-bold text-lg">{{ page.name }}</span>
                        <span class="text-sm text-gray-500"
                            >{{ page.followers }} followers</span
                        >
                    </span>
                </router-link>
            </li>
            <li class="w-full h-14 border-t border-t-gray-300">
                <button
                    class="h-full w-full flex items-center justify-between text-utOrange px-5 font-medium"
                >
                    Show more
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from "vue";
const props = defineProps(["title"]);
const pages = ref([
    {
        id: 1,
        name: "Autako Live",
        followers: "15k",
        img: "../storage/icons/page.jpg",
    },
    {
        id: 2,
        name: "Haikyuu",
        followers: "1.5k",
        img: "../storage/icons/page2.jpg",
    },
    {
        id: 3,
        name: "Osana",
        followers: "7.5k",
        img: "../storage/icons/page3.jpg",
    },
    {
        id: 4,
        name: "Naruto",
        followers: "350",
        img: "../storage/icons/page4.jpg",
    },
    {
        id: 5,
        name: "Asuka",
        followers: "43",
        img: "../storage/icons/page5.jpg",
    },
]);
</script>

<style></style>
