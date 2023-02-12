<template>
    <div
        v-if="isLoggedIN"
        class="w-full bg-white border px-2 py-2 sm:px-4 sm:py-3 border-gray-300 flex flex-col justify-between gap-3 rounded-md cursor-pointer"
        @click="showCreate = true"
    >
        <div class="w-full flex items-center text-gray-400 gap-3">
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
        v-if="showCreate"
        class="fixed top-0 right-0 bottom-0 left-0 bg-black bg-opacity-25 z-50 flex items-center justify-center"
    >
        <div class="w-[550px] pb-2 bg-white rounded-md">
            <CreateForm @hideCreateModel="showCreate = false" />
        </div>
    </div>
    <AmvPostLayout v-for="post in posts" :key="post.id" :post="post" />
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import store from "../../store";
import CreateForm from "../home/CreateForm.vue";
import AmvPostLayout from "../Layouts/AmvPostLayout.vue";

const emit = defineEmits(["toggleShowSkelton"]);

const showCreate = ref(false);
const posts = ref([]);
const stopSendingRequest = ref(false);
const showSkelton = ref(false);
const watingData = ref(false);
const info = ref({
    start: 0,
    end: 6,
});

const isLoggedIN = computed(() => {
    return store.state.user.token ? true : false;
});

function getAmv() {
    if (!watingData.value && !stopSendingRequest.value) {
        emit("toggleShowSkelton");
        watingData.value = true;
        store.dispatch("getAmv", info.value).then((res) => {
            emit("toggleShowSkelton");
            watingData.value = false;
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

// function deletePost(post) {
//     store.dispatch("deletePost", post.id).then((res) => {
//         if (!res.data.error) {
//             posts.value = posts.value.filter((p) => p !== post);
//         } else alert("Error try again later");
//     });
// }
</script>

<style></style>
