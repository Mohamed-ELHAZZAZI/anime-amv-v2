<template>
    <div
        class="min-[890px]:grid min-[1300px]:grid-cols-[minmax(250px,_300px)_minmax(600px,_1fr)_minmax(250px,_300px)] min-[1300px]:gap-16 min-[890px]:grid-cols-[minmax(250px,_300px)_minmax(550px,_1fr)] min-[890px]:gap-8 sm:p-7 p-2 flex flex-col"
    >
        <div class="min-[890px]:flex flex-col gap-10 hidden">
            <MostTrending />
            <FollowingPages title="Trending pages" />
        </div>
        <div class="flex flex-col sm:gap-6 gap-3">
            <ul class="w-full sm:h-14 h-12 bg-white flex">
                <li class="h-full w-1/2">
                    <button
                        @click="show = 'all'"
                        :class="
                            show === 'all'
                                ? 'border-utOrange text-utOrange font-semibold'
                                : 'border-gray-400 font-medium'
                        "
                        class="h-full w-full flex items-center justify-center gap-3 sm:border-b-2 border-b-2 text-lg"
                    >
                        All
                    </button>
                </li>
                <li class="h-full w-1/2">
                    <button
                        @click="show = 'following'"
                        :class="
                            show === 'following'
                                ? 'border-utOrange text-utOrange font-semibold'
                                : 'border-gray-400 font-medium'
                        "
                        class="h-full w-full flex items-center justify-center sm:border-b-2 border-b-2 text-lg"
                    >
                        Following
                    </button>
                </li>
            </ul>
            <AllPosts v-if="show === 'all'" />
        </div>
        <div class="min-[890px]:flex hidden flex-col gap-10">
            <FollowingPages title="Following pages" />
        </div>
    </div>
    <!-- <AmvPostLayoutVue
    v-for="post in posts"
    :key="post.id"
    :post="post"
    @deletePost="deletePost"
/>
<AmvPostSkeleton v-if="showSkelton" :count="count" /> -->
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import AmvPostLayoutVue from "../components/Layouts/AmvPostLayout.vue";
import AmvPostSkeleton from "../components/skeletons/AmvPostSkeleton.vue";
import store from "../store";
import MostTrending from "../components/home/MostTrending.vue";
import FollowingPages from "../components/home/FollowingPages.vue";
import AllPosts from "../components/home/AllPosts.vue";
const show = ref("all");
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

function deletePost(post) {
    store.dispatch("deletePost", post.id).then((res) => {
        if (!res.data.error) {
            posts.value = posts.value.filter((p) => p !== post);
        } else alert("Error try again later");
    });
}
</script>

<style></style>
