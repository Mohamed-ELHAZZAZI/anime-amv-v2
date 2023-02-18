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
                    <div class="h-full ml-auto flex items-end pb-10">
                        <button
                            @click="showUpdateProfile = true"
                            class="px-4 py-3 text-white bg-utOrange border-none rounded-lg"
                        >
                            Modify Profile
                        </button>
                    </div>
                </div>
            </div>
            <ModifyUserLayout
                v-if="showUpdateProfile"
                :user="userInfo"
                @closeModel="showUpdateProfile = false"
                @changeUserInfo="changeUserInfo"
            />
            <div
                class="w-full my-10 mx-1 min-[850px]:grid min-[850px]:grid-cols-[minmax(225px,300px)_minmax(550px,1fr)] gap-5"
            >
                <div class="min-[850px]:block hidden">
                    <MostTrending />
                </div>
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-5" v-if="posts">
                        <div
                            v-if="currentUser.id == userInfo.id"
                            class="w-full bg-white border px-2 py-2 sm:px-4 sm:py-3 border-gray-300 flex flex-col justify-between gap-3 rounded-md cursor-pointer"
                            @click="showCreate = true"
                        >
                            <div
                                class="w-full flex items-center text-gray-400 gap-3"
                            >
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
                            v-if="currentUser.id == userInfo.id && showCreate"
                            class="fixed top-0 right-0 bottom-0 left-0 bg-black bg-opacity-25 z-50 flex items-center justify-center"
                        >
                            <div
                                class="sm:w-[550px] w-full my-5 pb-2 bg-white rounded-md mx-1"
                            >
                                <CreateForm
                                    @hideCreateModel="showCreate = false"
                                    :toModifyPost="toModifyPost"
                                />
                            </div>
                        </div>
                        <AmvPostLayout
                            v-for="post in posts"
                            :key="post.id"
                            :post="post"
                            @modifyPost="modifyPost"
                            @deletePost="deletePost"
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
import { onBeforeMount, computed } from "@vue/runtime-core";
import { ref } from "vue";
import store from "../store";
import MostTrending from "../components/home/MostTrending.vue";
import AmvPostLayout from "../components/Layouts/AmvPostLayout.vue";
import UserHeaderSkeleton from "../components/skeletons/UserHeaderSkeleton.vue";
import AmvPostSkeleton from "../components/skeletons/AmvPostSkeleton.vue";
import CreateForm from "../components/home/CreateForm.vue";
import ModifyUserLayout from "../components/auth/ModifyUserLayout.vue";
const props = defineProps(["username"]);
const userInfo = ref();
const posts = ref();
const showHeaderSkeletpn = ref(true);
const showPostsSkeletpn = ref(true);
const stopSendingRequest = ref(false);
const watingData = ref(false);
const showCreate = ref();
const toModifyPost = ref(null);
const showUpdateProfile = ref(false);
onBeforeMount(() => {
    store.dispatch("getUser", props.username).then((res) => {
        userInfo.value = res.data.user;
        posts.value = res.data.posts;
        showHeaderSkeletpn.value = false;
        showPostsSkeletpn.value = false;
    });
});

const info = computed(() => {
    return {
        start: 6,
        end: 12,
        owner_id: userInfo.value?.id,
    };
});

const currentUser = computed(() => {
    return store.state.user.info;
});

window.onscroll = () => {
    let bottomOfWindow =
        document.documentElement.scrollTop +
        window.innerHeight -
        (document.documentElement.offsetHeight - 550);

    if (
        bottomOfWindow >= 0 &&
        !stopSendingRequest.value &&
        !watingData.value &&
        userInfo.value.id
    ) {
        watingData.value = true;
        showPostsSkeletpn.value = true;
        store.dispatch("getAmv", info.value).then((res) => {
            info.value.start += info.value.end;
            info.value.end += 6;
            watingData.value = false;
            showPostsSkeletpn.value = false;
            posts.value.push(...res.data.posts);
            console.log(res);
            if (!res.data.posts.length) {
                stopSendingRequest.value = true;
            }
        });
    }
};

function modifyPost(post) {
    toModifyPost.value = post;
    showCreate.value = true;
}

function deletePost(post) {
    store.dispatch("deletePost", post.id).then((res) => {
        if (!res.data.error) {
            posts.value = posts.value.filter((p) => p !== post);
        } else alert("Error try again later");
    });
}

function changeUserInfo(info) {
    userInfo.value = info;
    showUpdateProfile.value = false;
}
</script>

<style></style>
