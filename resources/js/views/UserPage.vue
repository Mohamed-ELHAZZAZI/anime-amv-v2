<template>
    <div
        class="w-full min-h-screen px-8 py-4 grid grid-cols-[1fr_300px] gap-14"
    >
        <div class="">
            <div
                class="relative w-full h-[425px] bg-cover bg-no-repeat bg-center rounded-[20px] overflow-hidden flex items-end"
                :style="{
                    backgroundImage: `url(${'../storage/icons/cover.jpg'})`,
                }"
            >
                <div
                    class="absolute top-0 right-0 left-0 bottom-0 bg-black bg-opacity-70 z-10"
                ></div>
                <div class="w-full h-64 flex items-center px-10 z-20 gap-5">
                    <div class="w-60">
                        <img
                            :src="'../storage/icons/page.jpg'"
                            class="rounded-full"
                            alt=""
                            style="box-shadow: 2px 2px 9px 1px #ffffff24"
                        />
                    </div>
                    <div class="w-60 flex flex-col gap-3">
                        <div class="flex flex-col">
                            <span
                                class="capitalize text-white font-semibold text-5xl"
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
            <div class="w-full my-10 grid grid-cols-[300px_1fr] gap-5">
                <div>
                    <MostTrending />
                </div>
                <div class="flex flex-col gap-5">
                    <AmvPostLayout
                        v-for="post in posts"
                        :key="post.id"
                        :post="post"
                    />
                </div>
            </div>
        </div>
        <div class="h-96">
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
const props = defineProps(["username"]);
const userInfo = ref();
const posts = ref();
onBeforeMount(() => {
    store.dispatch("getUser", props.username).then((res) => {
        userInfo.value = res.data.user;
        posts.value = res.data.posts;
        console.log(res.data);
    });
});
</script>

<style></style>
