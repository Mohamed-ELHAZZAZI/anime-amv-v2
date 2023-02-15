<template>
    <div
        class="fixed bottom-0 top-0 left-0 right-0 bg-black bg-opacity-40 z-30 flex justify-center items-center"
        @click.self="closeCommentSection"
    >
        <div
            class="w-full rounded md:max-w-[750px] min-h-[550px] bg-white flex flex-col z-40"
        >
            <div
                class="w-full h-16 flex items-center justify-center border-b-2 border-b-gray-300 font-semibold text-lg relative"
            >
                Comments
                <button
                    type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-800 hover:text-white"
                    @click="closeCommentSection"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="w-full h-[450px] overflow-auto px-12 flex py-2">
                <div class="antialiased mx-auto w-full">
                    <div class="space-y-4">
                        <div
                            class="flex"
                            v-for="comment in comments"
                            :key="comment.id"
                        >
                            <CommentsReplies :comment="comment" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex items-center justify-center px-3">
                <form class="w-full">
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only"
                        >Comment</label
                    >
                    <div class="relative flex py-2">
                        <textarea
                            @input="textAreaResizer"
                            id="textArea"
                            placeholder="Write your comment here..."
                            class="block resize-none w-full max-h-[100px] overflow-auto p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-utOrange focus:border-utOrange"
                        ></textarea>
                    </div>
                </form>
            </div>
            <CommentSkeleton v-if="showCommentSkeleton" :class="'mb-3'" />
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import store from "../../store";
import CommentSkeleton from "../skeletons/CommentSkeleton.vue";
import CommentsReplies from "../Layouts/CommentsLayout.vue";

const emit = defineEmits(["hideComment"]);
const props = defineProps(["post_id"]);
const showCommentSkeleton = ref(false);
const comments = ref([]);
onMounted(() => {
    store.dispatch("getComments", props.post_id).then((res) => {
        comments.value = res.data.comments;
    });
});

function closeCommentSection() {
    emit("hideComment");
}

function textAreaResizer() {
    let d = document.getElementById("textArea");
    d.style.height = "auto";
    d.style.height = `${d.scrollHeight}px`;
}
</script>

<style></style>
