<template>
    <AmvPostLayoutVue v-for="post in posts" :key="post.id" :post="post" />
    <AmvPostSkeleton v-if="showSkelton" :count="count" />
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import AmvPostLayoutVue from "../components/Layouts/AmvPostLayout.vue";
import AmvPostSkeleton from "../components/skeletons/AmvPostSkeleton.vue";
import store from "../store";

const posts = ref([]);
const count = ref(3);
const showSkelton = ref(false);
onMounted(() => {
    showSkelton.value = true;
    store.dispatch("getAmv").then((res) => {
        showSkelton.value = false;
        posts.value = res.data.posts;
    });
});
</script>

<style></style>
