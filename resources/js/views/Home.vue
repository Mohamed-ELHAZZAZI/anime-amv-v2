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
            <AllPosts
                v-if="show === 'all'"
                @toggleShowSkelton="showSkelton = !showSkelton"
            />
        </div>
        <div class="min-[890px]:flex hidden flex-col gap-10">
            <FollowingPages title="Following pages" />
        </div>
    </div>
    <AmvPostSkeleton v-if="showSkelton" :count="count" />
</template>

<script setup>
import { onMounted, ref } from "vue";
import store from "../store";
import AmvPostSkeleton from "../components/skeletons/AmvPostSkeleton.vue";
import MostTrending from "../components/home/MostTrending.vue";
import FollowingPages from "../components/home/FollowingPages.vue";
import AllPosts from "../components/home/AllPosts.vue";
const show = ref("all");
const showSkelton = ref(false);
const count = ref(3);
</script>

<style></style>
