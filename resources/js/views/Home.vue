<template>
    <AmvPostLayoutVue v-for="post in posts" :key="post.id" :post="post" />
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import AmvPostLayoutVue from "../components/Layouts/AmvPostLayout.vue";
import store from "../store";

const posts = ref([]);
onMounted(() => {
    store.dispatch("getAmv").then((res) => {
        posts.value = res.data.posts;
    });
});
</script>

<style></style>
