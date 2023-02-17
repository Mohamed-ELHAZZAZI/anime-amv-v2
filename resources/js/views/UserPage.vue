<template>
    <div
        class="w-full min-h-screen py-4 min-[1200px]:grid min-[1200px]:grid-cols-[minmax(850px,1fr)_minmax(250px,300px)] min-[1200px]:gap-10 min-[1200px]:px-8 min-[1100px]:gap-8 md:px-6 px-4"
    >
        <div class="">
            <UserHeaderSkeleton v-if="showHeaderSkeletpn" />
            <div
                v-else
                class="relative w-full min-[1200px]:h-[425px] h-[370px] bg-cover bg-no-repeat bg-center rounded-[20px] overflow-hidden flex items-end"
                :style="{
                    backgroundImage: `url(${'../storage/icons/cover.jpg'})`,
                }"
            >
                <div
                    class="absolute top-0 right-0 left-0 bottom-0 bg-black bg-opacity-70 z-10"
                ></div>
                <div
                    class="w-full sm:h-64 flex items-center px-10 z-20 gap-5 h-full flex-col sm:flex-row sm:py-0 py-4"
                >
                    <div class="min-[1200px]:w-60 md:w-48 w-36">
                        <img
                            :src="'../storage/icons/page.jpg'"
                            class="rounded-full"
                            alt=""
                            style="box-shadow: 2px 2px 9px 1px #ffffff24"
                        />
                    </div>
                    <div class="w-60 flex flex-col gap-3">
                        <div class="flex flex-col items-center sm:items-start">
                            <span
                                class="capitalize text-white font-semibold min-[1200px]:text-5xl md:text-4xl text-3xl"
                                >{{
                                    userInfo.firstName + " " + userInfo.lastName
                                }}</span
                            >
                            <span class="text-white text-sm text-opacity-80"
                                >@{{ userInfo.username }}</span
                            >
                        </div>
                        <span class="text-white text-lg"
                            >Welcome to my humble page!
                        </span>
                        <div class="flex justify-between text-white">
                            <span
                                ><span class="text-utOrange">19</span>
                                Following</span
                            >
                            <span
                                ><span class="text-utOrange">10k</span>
                                Followers</span
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="w-full my-10 mx-1 min-[850px]:grid min-[850px]:grid-cols-[minmax(225px,300px)_minmax(550px,1fr)] gap-5"
            >
                <div class="min-[850px]:block hidden">
                    <MostTrending />
                </div>
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-5" v-if="posts">
                        <AmvPostLayout
                            v-for="post in posts"
                            :key="post.id"
                            :post="post"
                        />
                    </div>
                    <AmvPostSkeleton :count="3" v-if="showPostsSkeletpn" />
                </div>
            </div>
        </div>
        <div class="h-96 hidden min-[850px]:flex">
            <MostTrending />
        </div>
    </div>
</template>

<script setup>
import { onBeforeMount } from "@vue/runtime-core";
import { ref } from "vue";
import store from "../store";
import MostTrending from "../components/home/MostTrending.vue";
import AmvPostLayout from "../components/Layouts/AmvPostLayout.vue";
import UserHeaderSkeleton from "../components/skeletons/UserHeaderSkeleton.vue";
import AmvPostSkeleton from "../components/skeletons/AmvPostSkeleton.vue";
const props = defineProps(["username"]);
const userInfo = ref();
const posts = ref();
const showHeaderSkeletpn = ref(true);
const showPostsSkeletpn = ref(true);
onBeforeMount(() => {
    store.dispatch("getUser", props.username).then((res) => {
        userInfo.value = res.data.user;
        posts.value = res.data.posts;
        showHeaderSkeletpn.value = false;
        showPostsSkeletpn.value = false;
    });
});
</script>

<style></style>
