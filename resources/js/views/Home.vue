<template>
    <AmvPostLayoutVue v-for="post in posts" :key="post.id" :post="post" />
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import AmvPostLayoutVue from "../components/Layouts/AmvPostLayout.vue";

const posts = ref([]);

const t = onMounted(() => {
    posts.value.push(
        {
            id: 1,
            userName: "Loyce Kuvalis",
            publishedDate: "16 December at 08:25",
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            video: "./storage/video/amv_by_med.mp4",
            comments: 33,
            likes: 8,
        },
        {
            id: 1,
            userName: "Loyce Kuvalis",
            publishedDate: "16 December at 08:25",
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            video: "./storage/video/amv_by_med.mp4",
            comments: 303,
            likes: 150,
        }
    );
});

console.log(posts.value);
</script>

<style></style>
