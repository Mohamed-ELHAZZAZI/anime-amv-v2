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
const stopSendingRequest = ref(false);
const info = ref({
    start: 0,
    end: 6,
});

function getAmv() {
    if (!showSkelton.value && !stopSendingRequest.value) {
        showSkelton.value = true;
        store.dispatch("getAmv", info.value).then((res) => {
            showSkelton.value = false;
            info.value.start += info.value.end;
            info.value.end += 6;
            posts.value.push(...res.data.posts);
            if (!res.data.posts.length) {
                stopSendingRequest.value = true;
            }
        });
    }
}

onMounted(() => {
    getAmv();
});

window.onscroll = () => {
    let bottomOfWindow =
        document.documentElement.scrollTop +
        window.innerHeight -
        (document.documentElement.offsetHeight - 550);

    if (bottomOfWindow >= 0) {
        getAmv();
    }
};
</script>

<style></style>
